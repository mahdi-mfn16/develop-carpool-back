<?php

namespace App\Console\Commands;

use App\Services\Command\CreateCityProvinceService;
use App\Services\CommandServices\ChangeProductOptionService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:city';

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
        try {
            Log::info('start create:city at '.now());
            $result = $this->createCityProvinceService->createCity();
            Log::info('finished create:city at '.now());
        } catch (Exception $e) {
            Log::info('error in create:city at '.now());
        }

    }
}
