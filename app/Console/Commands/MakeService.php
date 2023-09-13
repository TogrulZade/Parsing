<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}Service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Yeni Service class açmaq.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $service = $this->parseClassName($name);
        $path = app_path("Services/{$service}Service.php");
        $namespace = $this->laravel->getNamespace() . 'Services';

        $this->makeDirectory($path);

        $stub = $this->getStub();
        $stub = str_replace(
            ['{{namespace}}', '{{class}}'],
            [$namespace, $service],
            $stub
        );

        file_put_contents($path, $stub);

        $this->info("Service {$service}Service müvəffəqiyyətlə açıldı.");
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
        $stub = __DIR__ . '/stubs/service.stub';

        if (!file_exists($stub)) {
            $stub = base_path('vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/service.stub');
        }

        if (!file_exists($stub)) {
            throw new \Exception("Stub file not found.");
        }

        return file_get_contents($stub);
    }
}
