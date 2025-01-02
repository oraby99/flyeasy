<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UpdateUserProfileImageRequest;
use App\Http\Requests\UpdateUserProfileDataRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Services\UserProfileService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    private UserProfileService $userProfileService;

    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    public function updateProfileImage(UpdateUserProfileImageRequest $request): JsonResponse
    {
        if($profileImage = $this->userProfileService->updateProfileImage($request->validated()))
            return $this->success(['profile_image' => $profileImage]);

        return $this->failed();
    }

    public function updateProfileData(UpdateUserProfileDataRequest $request): JsonResponse
    {
        if($data = $this->userProfileService->updateProfileData($request->validated()))
            return $this->success($data);

        return $this->failed();
    }

    public function updatePassword(UpdateUserPasswordRequest $request): JsonResponse
    {
        if($this->userProfileService->updatePassword($request->validated()))
            return $this->success();

        return $this->failed();
    }

    public function logout(): JsonResponse
    {
        if($this->userProfileService->logout())
            return $this->success();

        return $this->failed();
    }
}
