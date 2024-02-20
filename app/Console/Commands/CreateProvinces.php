<?php

namespace App\Console\Commands;

use App\Services\Command\CreateCityProvinceService;
use App\Services\CommandServices\ChangeProductOptionService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateProvinces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:province';

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
            Log::info('start create:province at '.now());
            $result = $this->createCityProvinceService->createProvince();
            Log::info('finished create:province at '.now());
        } catch (Exception $e) {
            Log::info('error in create:province at '.now());
        }

    }
}
