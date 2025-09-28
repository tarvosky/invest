<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Payment;
use Carbon\Carbon;

class InvestmentService
{
    use Payment;
    /**
     * Processes all pending daily payouts for a given user.
     * This method is designed to be called when the user visits the dashboard.
     *
     * @param User $user
     * @return void
     */
    public function processDailyPayouts(User $user)
    {
        // Get all active investments for the user
        $investments = $user->investments()->where('status', 'active')->get();

        foreach ($investments as $investment) {
            // Determine the date from which to start processing payouts
            $lastPayoutDate = $investment->last_payout_date ?
                Carbon::parse($investment->last_payout_date)->startOfDay() :
                Carbon::parse($investment->start_date)->startOfDay();

            $today = Carbon::today();

            // Loop through each day since the last payout date until today
            while ($lastPayoutDate->lt($today)) {
                $lastPayoutDate->addDay();

                // Calculate the daily interest for the current day
                // The ROI is a percentage (e.g., 20), so we divide by 100
                // We're assuming a 30-day payout period based on your original ROI
                $dailyInterestRate = $investment->package->roi / 100 / $investment->package->duration_days;
                $dailyInterestAmount = $investment->initial_deposit * $dailyInterestRate;

                // Add the daily interest to the user's wallet
                // This uses your existing function, ensuring history is also updated
                $this->addDailyInterestToWallet($user, $dailyInterestAmount, $investment);
            }

            // Update the last payout date for the investment to today's date
            $investment->last_payout_date = now();
            $investment->save();
        }
    }

    /**
     * Adds the daily interest amount to the user's wallet and records it in history.
     *
     * @param User $user
     * @param float $amount
     * @param Investment $investment
     */
    protected function addDailyInterestToWallet(User $user, $amount, $investment)
    {
        // Add to wallet using your existing function
        $this->add_to_wallet_and_update($user, $amount);

        // Record the payout in the dedicated payouts table
        $investment->dailyInterestPayouts()->create([
            'amount' => $amount,
        ]);


        $user->histories()->create([
            'description' => 'Daily interest payout from ' . $investment->package->name . ' investment.',
            'balance' => $user->wallet,
            'ip' => request()->ip(),
        ]);
    }
}
