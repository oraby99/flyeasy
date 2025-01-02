<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    public function success($data = null): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'message'   => 'Operation has been done',
            'data'      => $data
        ]);
    }

    public function failed($message = null, $data = null): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => $message ?? 'Error happened',
            'data'      => $data
        ], 422);
    }

    public function wrongCredentials(): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => 'Wrong credentials',
            'data'      => null
        ], 401);
    }

    public function notVerified(): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => 'User not verified',
            'data'      => null
        ]);
    }

    public function notAuthenticated(): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => 'Unauthenticated',
            'data'      => null
        ], 401);
    }

    public function notActive(): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => 'User Not Active',
            'data'      => null
        ]);
    }

    public function notUserGroup(): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => 'Not User Group',
            'data'      => null
        ]);
    }

    public function modelNotFound(): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'message'   => 'Model Not Found',
            'data'      => null
        ]);
    }

    public function paginationResponse($data, $collection): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'message'   => 'Operation has been done',
            'data'      => [
                'collection'    => $data,
                'pagination'    => [
                    'total'         => $collection->total(),
                    'perPage'       => $collection->perPage(),
                    'currentPage'   => $collection->currentPage(),
                    'from'          => $collection->firstItem(),
                    'to'            => $collection->lastItem(),
                    'lastPage'      => $collection->lastPage(),
                    'urls'          => [
                        'previous'  => $collection->previousPageUrl(),
                        'nex'       => $collection->nextPageUrl()
                    ]
                ]
            ]
        ]);
    }
}
