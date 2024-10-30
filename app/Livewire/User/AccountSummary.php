<?php

namespace App\Livewire\User;

use App\Models\BankWithdrawal;
use App\Models\Transactions;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AccountSummary extends Component
{

    public function render()
    {

        $user_id = Auth::user()->id;

        $sum_withdrawal1 = Transactions::where('user_id', $user_id)
            ->where('transaction_category', 2)
            ->where('transaction_status', 2)
            ->sum('transaction_amount');
        $sum_bank_withdrawal = BankWithdrawal::where('user_id', $user_id)
            ->where('status', 2)
            ->sum('amount');

        $sum_withdrawal = $sum_withdrawal1 + $sum_bank_withdrawal;
        return view('livewire.user.account-summary', [
            "user_data" => Auth::user(),
            "sum_withdrawal" => $sum_withdrawal,
        ]);
    }
}
