<?php

namespace App\Console;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * Run cron to send emails
         */
        $schedule->call(function()
        {
            $emails = Email::whereNull('sent_at');
            $sent_id = [];
            foreach ($emails as $email)
            {
                if ($email->type == 1)
                {
                    $subject = 'New ecercising plans';
                    $message = 'You have been added to new exercising plans. Check them out!';
                } else {
                    $subject = 'Exercising plans updates';
                    $message = 'Your exercising plans have been updated, don\'t miss them!';
                }

                Mail::raw($msg, function($message)
                {
                    $message->from('contact@mygymonline.gym', 'My Gym online');
                    $message->to($email->user->email)->subject($subject);
                });

                $email->sent_at = Carbon::now();
                $email->save();
            }
        })
        ->daily()
        ->sendOutputTo('/var/log/mygymonline/mailing-' . Carbon::now()->format('YmdHis') . '.log');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
