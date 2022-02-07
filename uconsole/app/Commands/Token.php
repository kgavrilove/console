<?php

namespace App\Commands;

use App\Tools\IClient;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Cache;
class Token extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'token';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'get token';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info(Cache::get('token'));

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
