<?php

namespace App\Console\Commands;
//use vendor\nesbot\carbon\src\Carbon\Carbon;


use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;

class SendBirthdayEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email with a birthday wish to all users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $month = Carbon::createFromFormat('Y-m-d H:i:s',Carbon::today())->month;
        $day = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::today())->day;
        $users = User::whereMonth('birth_date', '=', $month)
                       ->whereDay('birth_date', '=', $day)
                       ->get(); 
        foreach( $users as $user ) {
            if($user) {
                Mail::queue('birthday.birthday', ['user' => $user], function($mail) use($user) {
                    $mail->to($user['email'])
                        ->from('jaya.sukirti@sts.in', 'Jaya Sukirti')
                        ->subject('Happy Birthday');
                });
            }    
        }  
        $this->info('The happy birthday messages were sent successfully!');
    }
}


