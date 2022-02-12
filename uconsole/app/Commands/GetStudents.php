<?php

namespace App\Commands;

use App\Tools\CurlCaller;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Cache;
use LaravelZero\Framework\Commands\Command;

class GetStudents extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'get_students';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get all Students data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $curl=new CurlCaller();
        $response=$curl->get('http://universityapi.loc/api/student',Cache::get('token'));
        $this->info($response);



    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
