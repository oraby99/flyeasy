<?php

namespace App\Console\Commands;

use App\Jobs\EndLibrarySubscription;
use Illuminate\Console\Command;
use App\Models\PlanUser;

class CheckEndingLibrarySubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'library-subscription:check-ending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check ending library subscriptions for all users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        PlanUser::where('end_at', '<', now())->get()->chunk(5, function ($subscription) {
            EndLibrarySubscription::dispatch($subscription);
        });
    }
}
