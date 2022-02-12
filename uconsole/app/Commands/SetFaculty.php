<?php

namespace App\Commands;

use App\Tools\CurlCaller;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Cache;
use LaravelZero\Framework\Commands\Command;

class SetFaculty extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'set_faculty
    {name : The name of the new faculty (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'add new faculty';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'name' => $this->argument('name'),
        ];
        $curl=new CurlCaller();
        $response=$curl->postWithToken('http://universityapi.loc/api/faculty',$data,Cache::get('token'));
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
