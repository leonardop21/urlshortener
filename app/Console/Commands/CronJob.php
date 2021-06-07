<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronJob:CronJob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove shortlinks expirados do Banco';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \DB::table('shortlinks')
            ->where('expiration_date', '<', date('Y-m-d'))
            ->delete();

    	$this->info('Shortlinks expirados removidos');
    }
}
