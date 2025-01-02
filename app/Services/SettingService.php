<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use Exception;

class SettingService extends Service
{
    public function all(): Collection
    {
        return Setting::all();
    }

    public function update($data): bool
    {
        DB::beginTransaction();
        try {
            foreach ($data as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            Log::error('Error while updating data of plan', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return false;
        }
    }
}
