<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessDailyPayout extends Command
{
    protected $signature = 'payouts:daily';
    protected $description = 'Process daily interest payouts for users with active investments';

    public function handle()
    {
        $this->info('Starting daily payout process...');

        // Process in chunks to avoid memory issues on large datasets
        User::whereNotNull('email_verified_at')
            ->whereHas('investments', fn($q) => $q->where('status', 'active'))
            ->with(['investments.package']) // eager load investments and package
            ->chunkById(100, function ($users) {
                foreach ($users as $user) {
                    // process each user's investments
                    foreach ($user->investments as $investment) {
                        if ($investment->status !== 'active') {
                            continue;
                        }

                        $dailyInterestRate = $investment->package->roi / 100 / $investment->package->duration_days;
                        $dailyInterestAmount = $investment->initial_deposit * $dailyInterestRate;

                        $this->processInvestmentPayout($user, $investment, $dailyInterestAmount);
                    }
                }
            });

        $this->info(' Daily payouts processed.');
        return Command::SUCCESS;
    }

    protected function processInvestmentPayout(User $user, $investment, $amount)
    {
        // Avoid duplicate payouts for the same day
        $alreadyPaid = $investment->dailyInterestPayouts()
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($alreadyPaid) {
            return;
        }

        // Wrap in transaction per-investment to keep things consistent
        DB::transaction(function () use ($user, $investment, $amount) {

            // Re-check inside transaction for race conditions
            $alreadyPaid = $investment->dailyInterestPayouts()
                ->whereDate('created_at', now()->toDateString())
                ->exists();

            if ($alreadyPaid) {
                return;
            }

            // Atomic increment on the users.wallet column
            // This avoids race conditions when multiple processes update the same user
            $user->increment('wallet', $amount);

            // Create payout record
            $investment->dailyInterestPayouts()->create([
                'amount' => $amount,
            ]);

            // Create history log. Use current wallet value from DB to be accurate.
            $user->refresh(); // refresh the model so $user->wallet is current

            $user->histories()->create([
                'description' => 'Daily interest payout from ' . $investment->package->name . ' investment.',
                'balance' => $user->wallet,
                'ip' => request()?->ip() ?? 'system',
            ]);
        });
    }
}
