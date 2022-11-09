<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:model {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $model  = $this->argument("name");

        $model = \Str::camel($model);
        $model = \Str::ucfirst($model);
        $plular = \Str::plural($model);
        $module = $this->argument("module");
        Artisan::call("module:make-model ${model} ${module} -m");
        Artisan::call("module:make-controller ${plular}Controller ${module} --api");
        Artisan::call("module:make-resource ${model}Resource ${module}");
        Artisan::call("module:make-seed ${model} ${module}");
        Artisan::call("module:make-policy ${model}Policy ${module} ");
    }
}
