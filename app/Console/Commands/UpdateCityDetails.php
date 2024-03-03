<?php

namespace App\Console\Commands;

use App\Services\Command\CreateCityProvinceService;
use App\Services\CommandServices\ChangeProductOptionService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCityDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:city-details {--chunk=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(

        private CreateCityProvinceService $createCityProvinceService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chunk = $this->option('chunk');
        try {
            Log::info('start update:city-details chunk = '.$chunk.' at '.now());
            $result = $this->createCityProvinceService->updateCityDetails($chunk);
            Log::info($result);
            Log::info('finished update:city-details chunk = '.$chunk.' at '.now());
        } catch (Exception $e) {
            Log::info($e->getMessage());
            Log::info('error in update:city-details chunk = '.$chunk.' at '.now());
        }

    }
}
