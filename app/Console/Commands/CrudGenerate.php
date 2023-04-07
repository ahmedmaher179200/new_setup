<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class crudGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {table} {model} {path}';

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
        $path = $this->argument('path');
        $seperator = '>> ';

        //make migration
        $this->info('make migration...');
        $this->info($seperator);
        Artisan::call('make:migration ' . $table);

        // make model
        $this->info('make model...');
        $this->info($seperator);
        $newfile = fopen(base_path('app/Models/' . $model . '.php'),'w');       //create model
        $file_content = file_get_contents(base_path('app/CrudGenerate/model.php'));  //take content
        $content = str_replace('@@table@@', $table ,$file_content);      //handel content
        $content = str_replace('@@model@@', $model ,$content);      //handel content
        fwrite($newfile, $content);
        fclose($newfile);

        $this->info('make request...');
        $this->info($seperator);
        $createRequestPath = $table . '/' . 'CreateRequest';
        $editRequestPath = $table . '/' . 'EditRequest';
        Artisan::call('make:request ' . $createRequestPath);
        Artisan::call('make:request ' . $editRequestPath);

        $this->info('make views...');
        File::makeDirectory(base_path('resources/views/'. $path . '/' . $table), 0777, true, true);
        $indexViewPath = base_path('resources/views/' . $path  . '/' . $table . '/index.blade.php');
        $createViewPath = base_path('resources/views/' . $path  . '/' . $table . '/create.blade.php');
        $editViewPath = base_path('resources/views/' . $path  . '/' . $table . '/edit.blade.php');;
        $formViewPath = base_path('resources/views/' . $path  . '/' . $table . '/form.blade.php');;
        copy(base_path('app/CrudGenerate/CrudViews/index.blade.php'), $indexViewPath);
        copy(base_path('app/CrudGenerate/CrudViews/edit.blade.php'), $editViewPath);
        copy(base_path('app/CrudGenerate/CrudViews/create.blade.php'), $createViewPath);
        copy(base_path('app/CrudGenerate/CrudViews/form.blade.php'), $formViewPath);

        // make controller
        $this->info('make controller...');
        $this->info($seperator);
        $controllerPath = $path . '/' . $model . 'Controller --resource';
        Artisan::call('make:controller ' . $controllerPath);

        $this->info("crud success.");
    }
}
