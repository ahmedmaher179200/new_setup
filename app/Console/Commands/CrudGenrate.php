<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class crudGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {table} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'handel crud command that you need';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $table = $this->argument('table');
        $model = $this->argument('model');
        $seperator = '>> ';

        $this->info('make migration...');
        $this->info($seperator);
        Artisan::call('make:migration ' . $table);

        $this->info('make model...');
        $this->info($seperator);
        Artisan::call('make:model ' . $model);

        $this->info('make controller...');
        $this->info($seperator);
        Artisan::call('make:controller ' . $model . 'Controller --resource');

        $this->info('make request...');
        $this->info($seperator);
        Artisan::call('make:request ' . $table . '/' . 'CreateRequest');
        Artisan::call('make:request ' . $table . '/' . 'EditRequest');

        $this->info("crud success.");
    }
}
