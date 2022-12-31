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
        $newfile = fopen(base_path('app/Models/' . $model . '.php'),'w');       //create model
        $file_content = file_get_contents(base_path('app/CrudGenerate/model.php'));  //take content
        $content = str_replace('@@table@@', $table ,$file_content);      //handel content
        $content = str_replace('@@model@@', $model ,$content);      //handel content
        fwrite($newfile, $content);
        fclose($newfile); //end


        $this->info('make controller...');
        $this->info($seperator);
        Artisan::call('make:controller Dashboard/' . $model . 'Controller --resource');

        $this->info('make request...');
        $this->info($seperator);
        Artisan::call('make:request ' . $table . '/' . 'CreateRequest');
        Artisan::call('make:request ' . $table . '/' . 'EditRequest');

        $this->info('make views...');
        File::makeDirectory(base_path('resources/views/' . $table), 0777, true, true);
        copy(base_path('app/CrudGenerate/CrudViews/index.blade.php'), base_path('resources/views/' . $table . '/index.blade.php'));
        copy(base_path('app/CrudGenerate/CrudViews/edit.blade.php'), base_path('resources/views/' . $table . '/edit.blade.php'));
        copy(base_path('app/CrudGenerate/CrudViews/create.blade.php'), base_path('resources/views/' . $table . '/create.blade.php'));
        copy(base_path('app/CrudGenerate/CrudViews/form.blade.php'), base_path('resources/views/' . $table . '/form.blade.php'));


        $this->info("crud success.");
    }
}
