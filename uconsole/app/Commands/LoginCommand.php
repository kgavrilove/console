<?php

namespace App\Commands;


use App\Tools\IClient;
use App\Tools\CurlCaller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;


class LoginCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'login
                            {email : The email of the user (required)}
                            {password : The password of the user (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'log in api';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'email' => $this->argument('email'),
            'password' => $this->argument('password'),
        ];

        $curl=new CurlCaller();
        $response=$curl->post('http://universityapi.loc/api/login',$data);
        Cache::put('token', $response['data']['api_token']);
        $this->info($this->argument('email').' '.$this->argument('password'));
        $this->info($response['data']['api_token']);
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
