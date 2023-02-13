<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Todo;
use Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to particular user on particular date and time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $usermail=User::select("email")->get();
        $emails=[];
        foreach($usermail as $mail){
            $emails[]=$mail['email'];
        }
        Mail::send('email',[],function($message) use($emails){
            $message->to($emails)->subject('this is subject');
        });
        // {

        //     $todos = Todo::where('user_id', Auth::user()->id)
        //                 ->whereMonth('date_time', date('m'))
        //                 ->whereDay('date_time', date('d'))
        //                 ->whereYear('date_time', date('Y'))
        //                 ->get();
      
        //     if ($todos->count() > 0) {
        //         foreach ($todos as $todo) {
        //             Mail::to($todo)->send(new SendMailDateTime($todo));
        //         }
        //     }
      
        //     return 0;
    
    
        // }
    }
}
