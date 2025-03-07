<?php

namespace App\Console\Commands;

use App\Jobs\UpdateUserOnlineStatus;
use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateOnlineStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-online-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update online status for users who have been inactive for more than 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('UpdateOnlineStatus scenario triggered!');
        $users = User::where('is_online', 1)
                     ->where('last_activity', '<', Carbon::now()->subMinutes(5))  
                     ->get();
    
        foreach ($users as $user) {
            Log::info("Setting user ID {$user->id} as offline. Last online was at {$user->last_activity}");
            $user->update(['is_online' => 0]);
            Log::info("User ID {$user->id} is now offline at " . now());
        }
    }
}
