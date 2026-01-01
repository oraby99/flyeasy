<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadFilesTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Arr;
use Exception;

class DeleteChannelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, UploadFilesTrait;

    private $channel;

    /**
     * Create a new job instance.
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Execute the job.
     */
   public function handle(): void
    {
        DB::beginTransaction();
        try {
            $logoData = json_decode($this->channel->logo, true);
            $path = Arr::get($logoData, 'logo');
            if (!empty($path)) {
                $this->deleteFile($path);
            }
            $this->channel->delete();
            DB::commit();
        } catch (Exception $e) {
            Log::error('Error while deleting a channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
        }
    }
}
