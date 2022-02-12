<?php

namespace App\Commands;


use App\Tools\CurlCaller;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Cache;
use LaravelZero\Framework\Commands\Command;

class UpdateStudent extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'update_student
                                   {id : The id of the student (required)}
                                   {name : The id of the student (required)}
                                   {age : The id of the student (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'update student';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('id:'.$this->argument('id'));
        $this->info('name:'.$this->argument('name'));
        $this->info('age:'.$this->argument('age'));
        $data = [
            'name' => $this->argument('name'),
            'age' => $this->argument('age'),
        ];
        $curl=new CurlCaller();
        $response=$curl->update('http://universityapi.loc/api/student/'.$this->argument('id'),$data,Cache::get('token'));

        $this->info('http://universityapi.loc/api/student/'.$this->argument('id'));
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
