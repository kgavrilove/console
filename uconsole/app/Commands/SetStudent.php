<?php

namespace App\Commands;

use App\Tools\CurlCaller;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Cache;
use LaravelZero\Framework\Commands\Command;

class SetStudent extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'set_student
                                {name : The id of the student (required)}
                                {age : The id of the student (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'add student to db';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'name' => $this->argument('name'),
            'age' => $this->argument('age'),
        ];
        $curl=new CurlCaller();
        $response=$curl->postWithToken('http://universityapi.loc/api/student',$data,Cache::get('token'));

        $this->info("****");
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
