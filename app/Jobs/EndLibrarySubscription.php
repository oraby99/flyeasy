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
use App\Models\UserSection;
use Exception;

class EndLibrarySubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $subscriptions;

    /**
     * Create a new job instance.
     */
    public function __construct($subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            foreach($this->subscriptions as $subscription) {
                UserSection::where('user_id', $subscription->user_id)->delete();
                $subscription->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            Log::error('Error while ending a library subscription for users', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            DB::rollBack();
        }
    }
}
