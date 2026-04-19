<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/storage-check', function () {
    $results = [
        'public_storage_exists' => file_exists(public_path('storage')),
        'public_storage_is_link' => is_link(public_path('storage')),
        'storage_app_public_exists' => file_exists(storage_path('app/public')),
        'app_url' => config('app.url'),
        'storage_url_config' => config('filesystems.disks.public.url'),
    ];

    // Try to create a test file
    \Illuminate\Support\Facades\Storage::disk('public')->put('link-test.txt', 'Link is working at ' . now());
    $results['test_file_created'] = \Illuminate\Support\Facades\Storage::disk('public')->exists('link-test.txt');
    $results['test_file_url'] = \Illuminate\Support\Facades\Storage::disk('public')->url('link-test.txt');
    $results['test_file_public_path_exists'] = file_exists(public_path('storage/link-test.txt'));

    return response()->json($results);
});
