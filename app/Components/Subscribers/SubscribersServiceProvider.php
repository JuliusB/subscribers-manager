<?php declare(strict_types=1);

namespace App\Components\Subscribers;

use App\Components\Subscribers\Contracts\FieldsManagerContract;
use App\Components\Subscribers\Contracts\FieldsRepositoryContract;
use App\Components\Subscribers\Contracts\FieldTypeValidatorContract;
use App\Components\Subscribers\Contracts\SubscriberRepositoryContract;
use App\Components\Subscribers\Contracts\SubscribersManagerContract;
use App\Components\Subscribers\Repositories\FieldsRepository;
use App\Components\Subscribers\Repositories\SubscribersRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class SubscribersServiceProvider
 *
 * @package App\Components\Subscribers
 */
class SubscribersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindSubscribersContracts();
        $this->bindFieldsContracts();
    }


    private function bindSubscribersContracts(): void
    {
        $this->app->bind(
            SubscriberRepositoryContract::class,
            SubscribersRepository::class
        );

        $this->app->bind(
            SubscribersManagerContract::class,
            SubscribersManager::class
        );
    }

    private function bindFieldsContracts(): void
    {
        $this->app->bind(
            FieldsRepositoryContract::class,
            FieldsRepository::class
        );

        $this->app->bind(
            FieldsManagerContract::class,
            FieldsManager::class
        );

        $this->app->bind(
            FieldTypeValidatorContract::class,
            FieldTypeValidator::class
        );
    }
}
