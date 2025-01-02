<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Exception;

class AuthService
{
    public function login($data): bool
    {
        try {
            if(Auth::attempt(['email' => Arr::get($data, 'email'), 'password' => Arr::get($data, 'password')]))
                return true;

            return false;
        } catch (Exception $e) {
            Log::error('Error while admin login', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
}
