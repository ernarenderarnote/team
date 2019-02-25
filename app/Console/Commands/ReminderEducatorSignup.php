<?php

namespace App\Console\Commands;

use DB;
use Mail;
use App\User;
use App\Mail\RememberEmail;
use Illuminate\Console\Command;

class ReminderEducatorSignup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:reminderSignup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder email if user are not complate all educator setup';

    /**
     *   @var users
     */
    protected $users;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {       
        parent::__construct();
        $this->users = User::getUserWithRole('employer')
                        ->whereNotIn('stepping', ['3'])
                        ->where(DB::raw('date_format(`created_at`,"%Y-%m-%d")') ,'=' , DB::raw('(CURRENT_DATE - INTERVAL 3 DAY)'))
                        ->get();
           

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->users->each(function($user) {
             Mail::to($user->email)->send(new RememberEmail($user));
        });
 
    }
}
