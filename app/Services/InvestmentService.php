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
//    public function processDailyPayouts(User $user)
//    {
//        $investments = $user->investments()->where('status', 'active')->get();
//
//        foreach ($investments as $investment) {
//            $lastPayoutDate = $investment->last_payout_date
//                ? Carbon::parse($investment->last_payout_date)->startOfDay()
//                : Carbon::parse($investment->start_date)->startOfDay();
//
//            $today = Carbon::today();
//
//            while ($lastPayoutDate->lt($today)) {
//                $dailyInterestRate = $investment->package->roi / 100 / $investment->package->duration_days;
//
//                // Simple interest (based on initial deposit)
//                $dailyInterestAmount = $investment->initial_deposit * $dailyInterestRate;
//
//                // Record the payout only if it doesn't exist
//                if (!$investment->dailyInterestPayouts()->whereDate('created_at', $lastPayoutDate->toDateString())->exists()) {
//                    $this->addDailyInterestToWallet($user, $dailyInterestAmount, $investment, $lastPayoutDate);
//                }
//
//                // Increment date
//                $lastPayoutDate->addDay();
//            }
//
//            // Update the investment's last payout date once after all missed days
//            $investment->last_payout_date = $lastPayoutDate->subDay()->toDateString(); // last actual payout day
//            $investment->save();
//        }
//    }




    /**
     * Adds the daily interest amount to the user's wallet and records it in history.
     *
     * @param User $user
     * @param float $amount
     * @param Investment $investment
     */
    protected function addDailyInterestToWallet(User $user, $amount, $investment)
    {
        // Only run if today’s payout doesn’t exist yet
        if (!$investment->dailyInterestPayouts()
            ->whereDate('created_at', now()->toDateString())
            ->exists()) {

            // Add to wallet
            $this->add_to_wallet_and_update($user, $amount);

            // Record the payout in the dedicated payouts table
            $investment->dailyInterestPayouts()->create([
                'amount' => $amount,
            ]);

            // Add to user history
            $user->histories()->create([
                'description' => 'Daily interest payout from ' . $investment->package->name . ' investment.',
                'balance' => $user->wallet,
                'ip' => request()->ip(),
            ]);
        }
    }

}
