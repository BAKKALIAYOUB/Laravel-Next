<?php

namespace App\Console;

use App\Events\NotificationContrat;
use App\Events\test;
use App\Models\Contrats;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $now = Carbon::now()->format("Y-m-d");
            $contrat_user = Contrats::whereDate("date_fin" , $now)->get();
            $users = User::all();

            $notification_ws = array();

            foreach($contrat_user as $c){
                foreach($users as $user){
                    if($user->id == $c->id_user){
                        $notification = new Notification();

                        $notification->id_user = $user->id;
                        $notification->id_contrat = $c->id;

                        $notification->description = "Contrat de " .$c->client->fullname." expiré le ".$c->date_fin;
                        $notification->save();
                        array_push($notification_ws , $notification);
                    }
                }
            }

            event (new NotificationContrat($notification_ws));
        })->everyMinute();
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
