<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Mail\AppMail;
use Livewire\Component;
use App\Models\AI_Plans;
use Illuminate\Support\Str;
use App\Models\Notifications;
use App\Models\Plans_Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AiPlans extends Component
{  

    public function ai_plans($id)  {
        
        $details = AI_Plans::where("id","$id")->get()->first();

        $data = (object) $details;

        $user_data = Auth::user();

        $full_name = $user_data->last_name . ' ' . $user_data->first_name;

        if ($data->amount > $user_data->balance) {
            session()->flash('error','insufficient Funds. Please fund your wallet');
            return redirect('/users/ai-plans');
        }

        $result = Plans_Transactions::create([
            "user_id" => $user_data->id,
            "plan_category" => 1,
            "plan_name" => $data->name,
            "plan_amount" => $data->amount,
            "plan_duration" => $data->duration,
            "plan_ROI" => $data->ROI,
            "plan_transaction_status" => 1,
        ]);

        if ($result) {

            $new_Balance = $user_data->balance - $data->amount ;

            User::where("id","$user_data->id")->update([
                "balance" => $new_Balance,
            ]);

            session()->flash('success', 'Your Investment Plan Purchase of $'.$data->amount.' was successful');

            redirect('/users/ai-plans');

            // send notification
            Notifications::create([
                "user_id" => $user_data->id,
                "notifications_id" => Str::random(),
                "notifications_category" => "Investment Plan Purchase",
                "notifications_message" => " Your Investment Plan Purchase of $$data->amount was successful. Thanks for choosing us",
                "notifications_status" => "Active",
            ]);

            
            // send mail
            $app = config('app.name');
            $userEmail = $user_data->email;

            $subject = "Investment Plan Purchase";


            $bodyUser = [
                "name" => $full_name,
                "title" => "Investment Plan Purchase",
                "message" => "Hello $full_name Your Investment Plan purchase of $$data->amount was successful. Plan Duration: $data->duration .  
                <br>
                <br>
                <em>THANKS FOR CHOOSING WITH US</em>"
            ];
            $bodyAdmin = [
                "name" => "Admin",
                "title" => "Investment Plan Purchase",
                "message" => " Hello Admin a User by the name $full_name have successfully made an Investment Plan purchase of $$data->amount on ".date('Y-M-d H:i ').". Plan Duration: $data->duration . Check his/her dashboard for further details;
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

            return;
        }

        session()->flash('error', 'An error occurred please try again later or contact support team');
        return redirect('/users/ai-plans');

    }

    public function render()
    {
        return view('livewire.user.ai-plans', [
            "ai_plans" => AI_Plans::all(),
        ]);
    }
}
