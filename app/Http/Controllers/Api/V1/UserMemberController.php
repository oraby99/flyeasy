<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserMemberResource;
use App\Http\Controllers\Controller;
use App\Services\UserMemberService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserMemberController extends Controller
{
    private UserMemberService $UserMemberService;

    public function __construct(UserMemberService $UserMemberService)
    {
        $this->UserMemberService = $UserMemberService;
    }

    public function getRelated(Request $request): JsonResponse
    {
        if($members = $this->UserMemberService->all($request->all()))
            $ids = [];
            foreach ($members as $member) {
                $ids[] = $member['id'];
            }
            return $this->success(UserMemberResource::collection($members));
        return $this->failed();
    }
}
