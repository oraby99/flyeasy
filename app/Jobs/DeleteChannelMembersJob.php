<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Exception;

class DeleteChannelMembersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $members;

    /**
     * Create a new job instance.
     */
    public function __construct($members)
    {
        $this->members = $members;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            $this->members->delete();
            DB::commit();
        } catch (Exception $e) {
            Log::error('Error while deleting members for channel', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
        }
    }
}
