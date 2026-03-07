<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeInvestmentModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:investment {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'investment App Module Files Created';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {

        $name = Str::studly($this->argument('name'));

        $this->generate($name);

        $this->info("Module {$name} generated successfully.");
    
    }

    protected function generate(string $name): void
    {
        // Model
        $this->call('make:model', [
            'name' => "InvestmentApp/{$name}"]
        );

        $input = $this->argument('name'); 

        $segments = explode('/', $input);

        $entity = Str::studly(end($segments));

        $modulePath = implode('/', array_slice($segments, 0, -1));

        $actions = ['Store', 'Edit', 'Show', 'Get', 'Update'];

        foreach ($actions as $prefix) {

            $className = $prefix . $entity;
            $directory = "Actions/InvestmentApp/{$modulePath}";

            $this->create("{$directory}/{$className}.php");
        }


        // Service
        $className = $entity . "Service";
        $directory = "Services/InvestmentApp";
        $this->create("{$directory}/{$className}.php");

        // Repository Contract
        $className = "Repository{$entity}Interface";
        $directory = "Repositories/InvestmentApp/Contracts/{$modulePath}";
        $this->create("{$directory}/{$className}.php");

        // Repository Eloquent
        $className = "Repository{$entity}";
        $directory = "Repositories/InvestmentApp/Eloquent/{$modulePath}";
        $this->create("{$directory}/{$className}.php");

        // DTO
        $this->create("Http/DTOs/InvestmentApp/{$name}Data.php");

        // Request
        $this->call('make:request', [
            'name' => "InvestmentApp/{$name}Request"
        ]);

        // Controller
        $this->call('make:controller', [
            'name' => "InvestmentApp/{$name}Controller",
            '--resource' => true
        ]);

        $this->create("Exceptions/InvestmentApp/{$name}Exception.php");
    }

    protected function create(string $path): void
    {
        $fullPath = app_path($path);

        if (!File::exists(dirname($fullPath))) {
            File::makeDirectory(dirname($fullPath), 0755, true);
        }

        if (!File::exists($fullPath)) {
            File::put($fullPath, "<?php\n\n");
            $this->line("Created: {$path}");
        } else {
            $this->warn("Skipped: {$path}");
        }
    }
}
