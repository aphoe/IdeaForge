<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeFilamentResourceViewShortCommand extends Command
{
    protected $signature = 'make:frv {model}';

    protected $description = 'Create a Filament resource view for a model';

    public function handle(): void
    {
        $this->call('make:filament-resource-view', [
            'model' => $this->argument('model'),
        ]);
    }
}
