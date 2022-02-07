<?php

namespace App\Commands;

use App\Tools\CurlCaller;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Cache;
use LaravelZero\Framework\Commands\Command;

class DeleteFaculty extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'delete_faculty
                                            {id : The id of the student (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'delete faculty by id';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $curl=new CurlCaller();
        $response=$curl->delete('http://universityapi.loc/api/faculty/'.$this->argument('id'),Cache::get('token'));
        $this->info("faculty with id:".$this->argument('id')." was deleted");
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
