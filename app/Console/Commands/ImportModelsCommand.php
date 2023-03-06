<?php

namespace App\Console\Commands;

use App\Services\ImportModels;
use Illuminate\Console\Command;

class ImportModelsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import car models by id';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $service = new ImportModels();
        $service->handle();
    }
}
