<?php

namespace App\Providers;

use App\Repositories\Eloquents\Admin\CityRepository;
use App\Repositories\Eloquents\Admin\GatewayRepository;
use App\Repositories\Eloquents\Admin\NotificationTypeRepository;
use App\Repositories\Eloquents\Admin\PreferenceOptionRepository;
use App\Repositories\Eloquents\Admin\PreferenceRepository;
use App\Repositories\Eloquents\Admin\ProvinceRepository;
use App\Repositories\Eloquents\Admin\RateRepository;
use App\Repositories\Eloquents\Admin\ReportTypeRepository;
use App\Repositories\Eloquents\Admin\VehicleRepository;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Eloquents\User\ChatRepository;
use App\Repositories\Eloquents\User\FileRepository;
use App\Repositories\Eloquents\User\MessageRepository;
use App\Repositories\Eloquents\User\NotificationRepository;
use App\Repositories\Eloquents\User\PassengerApplyRepository;
use App\Repositories\Eloquents\User\PaymentRepository;
use App\Repositories\Eloquents\User\ReportRepository;
use App\Repositories\Eloquents\User\ReviewRepository;
use App\Repositories\Eloquents\User\RideRepository;
use App\Repositories\Eloquents\User\UserRepository;
use App\Repositories\Eloquents\User\UserVehicleRepository;
use App\Repositories\Interfaces\Admin\CityRepositoryInterface;
use App\Repositories\Interfaces\Admin\GatewayRepositoryInterface;
use App\Repositories\Interfaces\Admin\NotificationTypeRepositoryInterface;
use App\Repositories\Interfaces\Admin\PreferenceOptionRepositoryInterface;
use App\Repositories\Interfaces\Admin\PreferenceRepositoryInterface;
use App\Repositories\Interfaces\Admin\ProvinceRepositoryInterface;
use App\Repositories\Interfaces\Admin\RateRepositoryInterface;
use App\Repositories\Interfaces\Admin\ReportTypeRepositoryInterface;
use App\Repositories\Interfaces\Admin\VehicleRepositoryInterface;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\User\ChatRepositoryInterface;
use App\Repositories\Interfaces\User\FileRepositoryInterface;
use App\Repositories\Interfaces\User\MessageRepositoryInterface;
use App\Repositories\Interfaces\User\NotificationRepositoryInterface;
use App\Repositories\Interfaces\User\PassengerApplyRepositoryInterface;
use App\Repositories\Interfaces\User\PaymentRepositoryInterface;
use App\Repositories\Interfaces\User\ReportRepositoryInterface;
use App\Repositories\Interfaces\User\ReviewRepositoryInterface;
use App\Repositories\Interfaces\User\RideRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Interfaces\User\UserVehicleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);

        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(ProvinceRepositoryInterface::class, ProvinceRepository::class);
        $this->app->bind(NotificationTypeRepositoryInterface::class, NotificationTypeRepository::class);
        $this->app->bind(ReportTypeRepositoryInterface::class, ReportTypeRepository::class);
        // $this->app->bind(GatewayRepositoryInterface::class, GatewayRepository::class);
        $this->app->bind(PreferenceRepositoryInterface::class, PreferenceRepository::class);
        $this->app->bind(PreferenceOptionRepositoryInterface::class, PreferenceOptionRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
        $this->app->bind(VehicleRepositoryInterface::class, VehicleRepository::class);


        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PassengerApplyRepositoryInterface::class, PassengerApplyRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(RideRepositoryInterface::class, RideRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);
        $this->app->bind(UserVehicleRepositoryInterface::class, UserVehicleRepository::class);
        // $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

        

    }
}
