<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {name}Repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Yeni Repository class açmaq';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $repository = $this->parseClassName($name);
        $variable = strtolower($repository);
        $path = app_path("Repositories/{$repository}Repository.php");
        $namespace = $this->laravel->getNamespace() . 'Repositories';


        $this->makeDirectory($path);

        $stub = $this->getStub();
        $stub = str_replace(
            ['{{namespace}}', '{{class}}', '{{variable}}'],
            [$namespace, $repository, $variable],
            $stub
        );

        file_put_contents($path, $stub);

        $this->info("Repository {$repository}Repository müvəffəqiyyətlə açıldı.");
    }

    protected function parseClassName($name)
    {
        return ucwords(str_replace('/', '\\', $name));
    }

    protected function makeDirectory($path)
    {
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }
    }

    protected function getStub()
    {
        $stub = __DIR__ . '/stubs/repository.stub';

        if (!file_exists($stub)) {
            $stub = base_path('vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/repository.stub');
        }

        if (!file_exists($stub)) {
            throw new \Exception("Stub file not found.");
        }

        return file_get_contents($stub);
    }
}
