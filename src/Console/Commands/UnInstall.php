<?php

namespace Springbuck\LaravelCoinhive\Console\Commands;

use Illuminate\Console\Command;

class UnInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coinhive:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Detach laravel-coinhive package from parent Laravel app.';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Under construction!!');
    }
}
