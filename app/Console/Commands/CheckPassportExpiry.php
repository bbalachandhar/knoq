<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckPassportExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-passport-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for expiring employee passports and sends notifications.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thresholdDays = 30; // Days before expiry to send notification
        $expiryThreshold = Carbon::now()->addDays($thresholdDays)->toDateString();

        $usersWithExpiringPassports = User::whereNotNull('passport_expiry_date')
            ->where('passport_expiry_date', '<=', $expiryThreshold)
            ->where('passport_expiry_date', '>=', Carbon::now()->toDateString())
            ->get();

        if ($usersWithExpiringPassports->isEmpty()) {
            $this->info('No passports expiring within the next ' . $thresholdDays . ' days.');
            return;
        }

        foreach ($usersWithExpiringPassports as $user) {
            $message = "Employee " . $user->name . " (ID: " . $user->id . ")'s passport will expire on " . $user->passport_expiry_date->format('Y-m-d') . ".";
            Log::warning($message);
            $this->warn($message);
            // In a real application, you would send a proper notification here, e.g.:
            // Notification::route('mail', 'admin@example.com')->notify(new PassportExpiryNotification($user));
            // Or save an in-app notification.
        }

        $this->info('Passport expiry check completed.');
    }
}
