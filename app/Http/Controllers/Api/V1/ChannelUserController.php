<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ChatUser;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\ChannelUserService;
use App\Http\Resources\JoinTeamResource;
use App\Http\Resources\AdminTeamResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RecentChatResource;
use App\Http\Requests\DeleteMembersRequest;
use App\Http\Requests\ForwardToUserRequest;
use App\Http\Resources\ArchivedTeamResource;

class ChannelUserController extends Controller
{
    private ChannelUserService $channelUserService;

    public function __construct(ChannelUserService $channelUserService)
    {
        $this->channelUserService = $channelUserService;
    }

    public function getAdminChannels(): JsonResponse
    {
        if($channels = $this->channelUserService->getAdminChannels())
            return $this->success(AdminTeamResource::collection($channels));

        return $this->failed();
    }

    public function getJoinedChannels(): JsonResponse
    {
        $channels = $this->channelUserService->getJoinedChannels();
    
        // Check if the returned value is false indicating an error
        if ($channels === false || $channels->isEmpty()) {
            return $this->success([]);
        }
    
        return $this->success(JoinTeamResource::collection($channels));
    }
    
    
    public function getArchivedChannels(): JsonResponse
    {
        if($channels = $this->channelUserService->getArchivedChannels())
            return $this->success(ArchivedTeamResource::collection($channels));

        return $this->failed();
    }

    public function forward(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'who_receive_message'  => ['required', 'array', 'min:1'],
            'who_receive_message.*'  => ['exists:users,id']
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
        $userIds = $request->input('who_receive_message');
        foreach ($userIds as $userId) {
            ChatUser::create([
                'who_start_chat'        => auth()->id(),
                'who_receive_message'   =>  $userId
            ]);
        }
        return $this->success();
    }
    public function deletechat($id) : JsonResponse
    {
        $ChatUser = ChatUser::find($id);
        if ($ChatUser) {
        $ChatUser->delete();
        return $this->success();
      }
      else
      return $this->failed();


    }

    public function recentChats(): JsonResponse
    {
        if($users = $this->channelUserService->recentChats())
            return $this->success(RecentChatResource::collection($users));

        return $this->failed();
    }

    public function deleteMembers(DeleteMembersRequest $request): JsonResponse
    {
        if($users = $this->channelUserService->deleteMembers($request->validated()))
            return $this->success();

        return $this->failed();
    }
}
