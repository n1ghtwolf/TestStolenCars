<?php

namespace App\Console\Commands;

use App\Services\ImportMarks;
use Illuminate\Console\Command;

class ImportMarksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-marks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import car marks';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $service = new ImportMarks();
        $service->import();
        
    }
}
