<?php

namespace Springbuck\LaravelCoinhive\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coinhive:install 
            {--P|publish=all : all, config, database, migrations, seeders}
            {--M|migrate=all : all or path}
            {--S|seed=class : all or class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Integrate laravel-coinhive package with parent Laravel app. 
            Publish (Config, Migrations and Seeders) files, Migrate and Seed database';

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
        $p = strtolower($this->option('publish'));
        $m = strtolower($this->option('migrate'));
        $s = strtolower($this->option('seed'));

        $calls = [
            'publish:config' => function (){
                $this->call('vendor:publish', [
                    '--tag' => 'coinhive-config', '--force' => true
                ]);
            },
            'publish:migrations' => function (){
                $this->call('vendor:publish', [
                    '--tag' => 'coinhive-migrations', '--force' => true
                ]);
            },
            'publish:seeders' => function (){
                $this->call('vendor:publish', [
                    '--tag' => 'coinhive-seeders', '--force' => true
                ]);
            },
            'migrate' => function (boolean $path){
                $this->call('migrate', ($path) ? [
                    '--path' => __DIR__.'../../database/migrations'
                ] : []);
            },
            'seed' => function (boolean $class){
                $this->call('db:seed', ($class) ? [
                    '--class' => 'Springbuck\LaravelCoinhive\Database\Seeds\DatabaseSeeder'
                ] : []);
            }
        ];

        // run publish options
        $this->info('Publishing '.$p.' files');
        [
            'all' => function (){
                $calls['publish:config']();
                $calls['publish:migrations']();
                $calls['publish:seeders']();
            },
            'config' => function (){
                $calls['publish:config']();
            },
            'database' => function (){
                $calls['publish:migrations']();
                $calls['publish:seeders']();
            },
            'migrations' => function (){
                $calls['publish:migrations']();
            },
            'seeders' => function (){
                $calls['publish:seeders']();
            }
        ][$p]();
        $this->info('Publishing '.$p.' files...completed');

        // run migrate options
        $this->info('Migrating '.$m.' schemas');
        [
            'all' => function (){
                $calls['migrate'](false);
            },
            'path' => function (){
                $calls['migrate'](true);
            }
        ][$m]();
        $this->info('Migrating '.$m.' schemas...completed');

        // run seed options
        $this->info('Seeding '.$p.' database');
        [
            'all' => function (){
                $calls['seed'](false);
            },
            'class' => function (){
                $calls['seed'](true);
            }
        ][$s]();
        $this->info('Seeding '.$p.' database...completed');
    }
}
