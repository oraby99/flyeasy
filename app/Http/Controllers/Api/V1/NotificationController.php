<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Channel;
use App\Models\ChatUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Services\ChannelService;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserWithSubscriptionCountsResource;
use Google_Client;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    private ChannelService $channelService;
    public function __construct(ChannelService $channelService)
    {
        $this->channelService = $channelService;
    }
    public static function sendFCMNotification($data, $credentialsFile)
    {
        try {
            // إعداد عميل Google
            $client = new Google_Client();
            $credentialsFilePath = Http::get(asset('teams-layered-firebase-adminsdk-7yonx-8d95035546_copy.json'));
            
            if (!$credentialsFilePath || $credentialsFilePath->status() != 200) {
                \Log::error('Failed to load Firebase credentials file.');
                return ['error' => 'Failed to retrieve Firebase credentials'];
            }
    
            $client->setAuthConfig($credentialsFilePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $token = $client->fetchAccessTokenWithAssertion();
    
            if (is_null($token) || !isset($token['access_token'])) {
                \Log::error('Failed to retrieve access token.');
                return ['error' => 'Failed to retrieve access token'];
            }
    
            $access_token = $token['access_token'];
            $headers = [
                "Authorization: Bearer $access_token",
                'Content-Type: application/json'
            ];
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/teams-layered/messages:send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
            // إرسال البيانات مع إزالة الحقل "registration_ids" من "message"
            $postData = [
                "message" => [
                    "notification" => [
                        "title" => $data["notification"]["title"],
                        "body" => $data["notification"]["body"],
                    ],
                    "data" => $data["data"],
                    // يُفترض أنك تريد إرسال إشعارات لأجهزة متعددة
                    "token" => $data["registration_ids"][0], // هنا تم استخدام `token` للإشارة إلى جهاز واحد فقط
                ]
            ];
    
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    
            $response = curl_exec($ch);
            if ($response === false) {
                return ['error' => curl_error($ch)];
            }
    
            curl_close($ch);
            return ['response' => json_decode($response, true)];
        } catch (\Exception $e) {
            \Log::error('Exception: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
    public function usernotification(Request $request)
    {
        $from = $request->input('from');
        $userIds = $request->input('user_ids');
        $fromUser = User::find($from);
        if (!$fromUser) {
            return response()->json(['message' => 'Invalid sender'], 400);
        }
        $recentChat = ChatUser::where('who_start_chat', $from)
            ->whereIn('who_receive_message', $userIds)
            ->first();
        if (!$recentChat) {
            return response()->json(['message' => 'No recent chat found'], 400);
        }
        $recentChat->increment('notify_counter');
        $recentChat->increment('counter');
        $tokens = [];
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user && !is_null($user->device_token)) {
                $tokens[] = $user->device_token;
                Notification::create([
                    'user_id' => $user->id,
                    'chat_user_id' => $recentChat->id,
                    'from' => $from,
                    'type' => 0,
                    'profile_image' => $fromUser->profile_image,
                    'username' => $fromUser->name,
                    'message' => 'You have a new message from ' . $fromUser->name,
                ]);
            }
        }
        if (empty($tokens)) {
            return response()->json(['message' => 'No valid users found'], 400);
        }
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => 'Teams Link',
                "body" => 'You have a new message from ' . $fromUser->name,
            ],
            "data" => [
                "user_id" => (string)$fromUser->id,
                "user_name" => $fromUser->name,
                "user_logo" => $fromUser->profile_image ? asset('storage/' . $fromUser->profile_image) : asset('admin/images/profile.png'),
                "type" => "0",
                "chat_user_id" => (string)$recentChat->id
            ]
        ];
        $response = self::sendFCMNotification($data, 'teams-layered-firebase-adminsdk.json');
        if (!empty($response['error'])) {
            return response()->json(['message' => 'Error: ' . $response['error']], 500);
        }
        return response()->json(['message' => 'Notifications sent successfully', 'response' => $response['response']]);
    }
    public function chanelnotification(Request $request, Channel $channel)
    {
        $from = $request->input('from');
        $fromuser = User::find($from);
        if (!$fromuser) {
            return response()->json(['message' => 'Invalid sender'], 400);
        }
    
        $users = $this->channelService->getModeratorsGuests($channel);
        $tokens = [];
        $Ids = [];
    
        foreach ($users as $user) {
            $Ids[] = $user['id'];
        }
    
        $recent = ChatUser::select('who_start_chat', 'who_receive_message', 'id', 'notify_counter', 'counter')
            ->where('who_start_chat', $from)
            ->whereIn('who_receive_message', $Ids)
            ->groupBy('who_start_chat', 'who_receive_message')
            ->first();
    
        if (!$recent) {
            return response()->json(['message' => 'No recent chat found'], 400);
        }
    
        // Update notification and chat counters
        $channel->increment('notify_counter');
        $recent->increment('counter');
    
        // Collect tokens and create notifications
        foreach ($users as $user) {
            if ($user['id'] != $fromuser->id && !empty($user['device_token'])) {
                $tokens[] = $user['device_token'];
                Notification::create([
                    'user_id' => $user['id'],
                    'from' => $from,
                    'channel_id' => $channel->id,
                    'type' => 1,
                    'channel_image' => $fromuser->channel_image,
                    'message' => 'You Have A New Message from ' . $fromuser->name . ' in channel ' . $channel->name,
                ]);
            }
        }
    
        if (empty($tokens)) {
            return response()->json(['message' => 'No valid users found'], 400);
        }
    
        // Prepare the data for Firebase notification
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => 'Teams Link',
                "body" => 'You Have A New Message from ' . $fromuser->name . ' in channel ' . $channel->name,
                "sound" => "default"
            ],
            "data" => [
                "channel_id" => (string)$channel->id,
                "channel_name" => $channel->name,
                "channel_logo" => $channel->logo == null ? asset('admin/images/OIG__36_-removebg.png') : asset('storage/' . $channel->logo),
                "type" => "1",
            ]
        ];
    
        // Send the notification using sendFCMNotification method
        $response = self::sendFCMNotification($data, 'teams-layered-firebase-adminsdk.json');
        if (!empty($response['error'])) {
            return response()->json(['message' => 'Error: ' . $response['error']], 500);
        }
    
        return response()->json(['message' => 'Notifications sent successfully', 'response' => $response['response']]);
    }
    public function index()
    {
        $data = Notification::with('user')->where('user_id', auth()->id())->latest()->simplePaginate(15);
        return  NotificationResource::collection($data);
    }
    public function notificationCounter()
    {
        $data = ChatUser::where('who_receive_message', auth()->id())->first();
        return  $data;
    }
    public function resetnotification()
    {
        $user = ChatUser::where('who_receive_message', auth()->id())->first();
        if ($user) {
            $user->update([
                'counter' => 0,
            ]);
            return $this->success();
        }
        else
        return $this->failed();
    }
    public function resetusernotification($id)
    {
        $user = ChatUser::find($id);
        if ($user) {
            $user->update([
                'notify_counter' => 0,
            ]);
            return $this->success();
        }
        else
        return $this->failed();
    }
    public function resetchanelnotification($id)
    {
        $user = Channel::find($id);
        if ($user) {
            $user->update([
                'notify_counter' => 0,
            ]);
            return $this->success();
        }
        else
        return $this->failed();
    }
    public function deletenotification($id)
    {
        $Notification = Notification::find($id);
        if ($Notification) {
            $Notification->delete();
            return $this->success();
        }
        else
        return $this->modelNotFound();
    }
}