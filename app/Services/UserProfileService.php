<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadFilesTrait;
use Illuminate\Support\Arr;
use Exception;

class UserProfileService
{
    use UploadFilesTrait;

    public function updateProfileImage($data): string|bool
    {
        DB::beginTransaction();
        try {
            $profileImage = $this->uploadFile(Arr::get($data, 'image'), 'users/profiles/images')['full_file_path'];
            auth()->user()->update(['profile_image' => $profileImage]);
            DB::commit();
            return url('storage/app/' . auth()->user()->profile_image);
        } catch (Exception $e) {
            Log::error('Error while updating a user for his profile image', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    public function updateProfileData($data): array|bool
    {
        DB::beginTransaction();
        try {
            auth()->user()->update($data);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            Log::error('Error while updating a user for his profile data', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    public function updatePassword($data): bool
    {
        DB::beginTransaction();
        try {
            auth()->user()->update(['password' => Arr::get($data, 'new_password')]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while updating a user for his profile data', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
            return false;
        }
    }

    public function logout(): bool
    {
        try {
            $user = auth()->user();
            $user->tokens()->delete();
            return true;
        } catch (Exception $e) {
            Log::error('Error while logout a user', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
}
