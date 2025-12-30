<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Channel;
use App\Models\ChatUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Services\ChannelService;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    private ChannelService $channelService;

    public function __construct(ChannelService $channelService)
    {
        $this->channelService = $channelService;
    }

    /**
     * Send Firebase Cloud Message (HTTP v1)
     */
    public static function sendFCMNotification(array $data): array
    {
        try {
            $credentialsPath = storage_path('app/firebase/service-account.json');

            if (!file_exists($credentialsPath)) {
                Log::error('Firebase credentials file not found', [
                    'path' => $credentialsPath
                ]);
                return ['error' => 'Firebase credentials file not found'];
            }

            $client = new GoogleClient();
            $client->setAuthConfig($credentialsPath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

            $token = $client->fetchAccessTokenWithAssertion();

            if (!isset($token['access_token'])) {
                Log::error('Failed to retrieve Firebase access token', $token);
                return ['error' => 'Failed to retrieve Firebase access token'];
            }

            $accessToken = $token['access_token'];

            $response = Http::withToken($accessToken)
                ->post(
                    'https://fcm.googleapis.com/v1/projects/teams-layered/messages:send',
                    [
                        'message' => [
                            'token' => $data['token'],
                            'notification' => $data['notification'],
                            'data' => $data['data'],
                        ],
                    ]
                );

            if (!$response->successful()) {
                Log::error('FCM request failed', [
                    'response' => $response->body()
                ]);
                return ['error' => 'FCM request failed'];
            }

            return ['response' => $response->json()];

        } catch (\Throwable $e) {
            Log::error('FCM Exception', [
                'message' => $e->getMessage()
            ]);
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * User to User Notification
     */
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

        foreach ($userIds as $userId) {
            $user = User::find($userId);

            if (!$user || empty($user->device_token)) {
                continue;
            }

            Notification::create([
                'user_id' => $user->id,
                'chat_user_id' => $recentChat->id,
                'from' => $from,
                'type' => 0,
                'profile_image' => $fromUser->profile_image,
                'username' => $fromUser->name,
                'message' => 'You have a new message from ' . $fromUser->name,
            ]);

            $payload = [
                'token' => $user->device_token,
                'notification' => [
                    'title' => 'Teams Link',
                    'body' => 'You have a new message from ' . $fromUser->name,
                ],
                'data' => [
                    'user_id' => (string) $fromUser->id,
                    'user_name' => $fromUser->name,
                    'type' => '0',
                    'chat_user_id' => (string) $recentChat->id,
                ],
            ];

            self::sendFCMNotification($payload);
        }

        return response()->json(['message' => 'Notifications sent successfully']);
    }

    /**
     * Channel Notification
     */
    public function chanelnotification(Request $request, Channel $channel)
    {
        $from = $request->input('from');
        $fromUser = User::find($from);

        if (!$fromUser) {
            return response()->json(['message' => 'Invalid sender'], 400);
        }

        $users = $this->channelService->getModeratorsGuests($channel);

        $channel->increment('notify_counter');

        foreach ($users as $user) {
            if ($user['id'] == $fromUser->id || empty($user['device_token'])) {
                continue;
            }

            Notification::create([
                'user_id' => $user['id'],
                'from' => $from,
                'channel_id' => $channel->id,
                'type' => 1,
                'channel_image' => $fromUser->channel_image,
                'message' => 'New message in ' . $channel->name,
            ]);

            $payload = [
                'token' => $user['device_token'],
                'notification' => [
                    'title' => 'Teams Link',
                    'body' => 'New message from ' . $fromUser->name . ' in ' . $channel->name,
                ],
                'data' => [
                    'channel_id' => (string) $channel->id,
                    'channel_name' => $channel->name,
                    'type' => '1',
                ],
            ];

            self::sendFCMNotification($payload);
        }

        return response()->json(['message' => 'Channel notifications sent']);
    }

    /**
     * Get Notifications
     */
    public function index()
    {
        $data = Notification::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->simplePaginate(15);

        return NotificationResource::collection($data);
    }

    public function notificationCounter()
    {
        return ChatUser::where('who_receive_message', auth()->id())->first();
    }

    public function resetnotification()
    {
        $user = ChatUser::where('who_receive_message', auth()->id())->first();

        if ($user) {
            $user->update(['counter' => 0]);
            return $this->success();
        }

        return $this->failed();
    }

    public function deletenotification($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->delete();
            return $this->success();
        }

        return $this->modelNotFound();
    }
}
