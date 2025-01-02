<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserWithSubscriptionCountsResource;
use App\Http\Requests\DuplicateChannelRequest;
use App\Http\Requests\ArchiveChannelRequest;
use App\Http\Resources\ChannelUserResource;
use App\Http\Requests\CreateChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\ChannelService;
use Illuminate\Http\Request;
use App\Models\Channel;

class ChannelController extends Controller
{
    private ChannelService $channelService;

    public function __construct(ChannelService $channelService)
    {
        $this->channelService = $channelService;
    }

    public function store(CreateChannelRequest $request): JsonResponse
    {
        if($currentAuthenticated = $this->channelService->store($request->validated()))
            return $this->success(new UserResource($currentAuthenticated));

        return $this->failed();
    }

    public function update(UpdateChannelRequest $request, Channel $channel): JsonResponse
    {
        if($currentAuthenticated = $this->channelService->update($request->validated(), $channel))
            return $this->success(new UserResource($currentAuthenticated));

        return $this->failed();
    }

    public function show(Channel $channel): JsonResponse
    {
         $channel->loadMissing(['moderators', 'guests', 'creator']);
        return $this->success(new ChannelResource($channel));
    }

    public function destroy(Channel $channel): JsonResponse
    {
        if($currentAuthenticated = $this->channelService->delete($channel))
            return $this->success(new UserResource($currentAuthenticated));

        return $this->failed();
    }

    public function archive(ArchiveChannelRequest $request): JsonResponse
    {
        if($this->channelService->archive($request->validated()))
            return $this->success();

        return $this->failed();
    }

    public function duplicate(DuplicateChannelRequest $request): JsonResponse
    {
        $result = $this->channelService->duplicate($request->validated());

        if(gettype($result) == 'string')
            return $this->failed($result);

        if($result)
            return $this->success(new UserResource($result));

        return $this->failed();
    }

    public function getModeratorsGuests(Channel $channel): JsonResponse
    {
        if($users = $this->channelService->getModeratorsGuests($channel))
            return $this->success(UserWithSubscriptionCountsResource::collection($users));

        return $this->failed();
    }

    public function getAuthenticatedJoined(Request $request): JsonResponse
    {
        $channels = $this->channelService->getAuthenticateJoined($request->all());
    
        if ($channels) {
            return $this->success(ChannelUserResource::collection($channels));
        }
    
        return $this->failed();
    }
    
}
