<?php

namespace App\Commands;

use App\Tools\CurlCaller;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Cache;
use LaravelZero\Framework\Commands\Command;

class UpdateFaculty extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'update_faculty
                                   {id : The id of the faculty (required)}
                                   {name : The id of the faculty (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('id:'.$this->argument('id'));
        $this->info('name:'.$this->argument('name'));
        $data = [
            'name' => $this->argument('name'),

        ];
        $curl=new CurlCaller();
        $response=$curl->update('http://universityapi.loc/api/faculty/'.$this->argument('id'),$data,Cache::get('token'));
        $this->info('http://universityapi.loc/api/faculty/'.$this->argument('id'));
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
