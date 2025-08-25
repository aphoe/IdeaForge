<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeFilamentResourceViewCommand extends Command
{
    protected $signature = 'make:filament-resource-view {model}';

    protected $description = 'Create a Filament resource view for a model';

    public function handle(): void
    {
        $model = $this->argument('model');

        $command = "php artisan make:filament-page View{$model} --resource={$model}Resource --type=ViewRecord";

        $response = passthru($command);

        $this->info($response);
    }
}
