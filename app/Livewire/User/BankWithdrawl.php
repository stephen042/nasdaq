<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Mail\AppMail;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Notifications;
use Livewire\Attributes\Rule;
use App\Models\BankWithdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BankWithdrawl extends Component
{
    #[Rule('required', message: 'Please fill in Account name')]
    public $account_name;

    #[Rule('required', message: 'Please fill in Account number')]
    #[Rule('min:10', message: 'Account number must be 10 digits')]
    #[Rule('max:10', message: 'Account number must be 10 digits')]
    public $account_number;

    #[Rule('required', message: 'Please fill in Bank name')]
    public $bank_name;

    public $amount;
    protected $rules = [
        'amount' => ['required', 'numeric', 'min:5000'],
    ];

    protected $messages = [
        'amount.required' => 'Please input amount',
        'amount.min' => 'Bank withdrawal Amount should be at least $5000',
    ];

    public function updated($amount)
    {
        $this->validateOnly($amount);
    }

    #[Rule('required', message: 'Please fill in Account type')]
    public $account_type;

    #[Rule('required', message: 'Please fill in your full house address')]
    public $full_address;

    #[Rule('required', message: 'Please fill in your SWIFT/BIC code')]
    public $swift_bic_code;

    public function bank_withdraw()
    {
        $this->validate();

        $current_bal = Auth::user()->earnings_balance;
        $user_id = Auth::user()->id;
        $full_name = Auth::user()->last_name . ' ' . Auth::user()->first_name;

        if ($current_bal < $this->amount) {
            session()->flash('error', 'insufficient Earning Funds');
            return $this->redirect('/users/bank_withdraw');
        }

        $result = BankWithdrawal::create([
            "user_id" => $user_id,
            "account_name" => $this->account_name,
            "account_number" => $this->account_number,
            "bank_name" => $this->bank_name,
            "amount" => $this->amount,
            "account_type" => $this->account_type,
            "full_address" => $this->full_address,
            "swift_bic_code" => $this->swift_bic_code,
            "status" => 1,
        ]);

        if ($result) {
            $new_balance =  $current_bal - $this->amount;

            User::where('id', "$user_id")->update([
                "earnings_balance" => "$new_balance",
            ]);

            $amount = $this->amount;
            session()->flash('success', 'Bank Withdrawal Request Sent');
            $this->redirect('/users/bank_withdraw');


            // send notification
            Notifications::create([
                "user_id" => $user_id,
                "notifications_id" => Str::random(),
                "notifications_category" => "Bank withdrawal Request",
                "notifications_message" => " Hello $full_name your Bank withdrawal request of $$amount was submitted successfully on " . date('Y-M-d H:i') . ". Check your email for full details. Thanks for choosing us",
                "notifications_status" => "Active",
            ]);

            // send mail
            $app = config('app.name');
            $userEmail = Auth::user()->email;

            $subject = "Bank Withdrawal Request Notification";


            $bodyUser = [
                "name" => $full_name,
                "title" => "Withdrawal Request",
                "message" => "Hello $full_name Your Bank withdrawal request of $$amount was submitted successfully your account will be credited after confirmation .  
                            <br>
                            <br>
                            <em>THANKS FOR TRADING WITH US</em>"
            ];
            $bodyAdmin = [
                "name" => "Admin",
                "title" => "Customer Bank Withdrawal Request",
                "message" => " Hello Admin a User by the name $full_name have successfully made a Bank withdrawal Request of $$amount on " . date('Y-M-d H:i ') . ". Check his/her dashboard for further details;
                            ",
            ];

            try {
                // user email
                Mail::to($userEmail)->send(new AppMail($subject, $bodyUser));

                // Admin email
                Mail::to(config('app.Admin_email'))->send(new AppMail($subject, $bodyAdmin));
            } catch (\Throwable $th) {
                //throw $th;
            }

            return $this->reset();
        }

        session()->flash('error', 'An error occurred please try again later or contact support team');
        return $this->redirect('/users/bank_withdraw');
    }

    public function render()
    {
        return view('livewire.user.bank-withdrawl');
    }
}
