<?php
namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateUserOnlineStatus
{
    public function handle()
    {
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
