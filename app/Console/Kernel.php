<?php

namespace App\Console;

use App\Word;
use Faker\Factory;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;

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
   * @param  \Illuminate\Console\Scheduling\Schedule $schedule
   * @return void
   */
    protected function schedule(Schedule $schedule)
    {

       $schedule->call(function () {

         $today = explode(' ',Carbon::now()->toDateTimeString() )[0];
         $faker = Factory::create();
         Word::create([
           'longdate' => $today,
           'word' => ucfirst($faker->word)
         ]);
       })->dailyAt('6:00');

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
