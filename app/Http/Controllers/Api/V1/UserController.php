<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUsersWithoutAuthenticated(Request $request): JsonResponse
    {
        $users = $this->userService->getModeratorsAndGuests($request->all());
    
        if ($users) {
            return $this->success(UserResource::collection($users));
        }
    
        return $this->failed();
    }
    
}
