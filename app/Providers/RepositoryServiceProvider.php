<?php


namespace App\Providers;

use App\Repositories\Challenge\ChallengeRepository;
use App\Repositories\Challenge\ChallengeRepositoryEloquent;
use App\Repositories\CollectPoint\CollectPointRepository;
use App\Repositories\CollectPoint\CollectPointRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\Waste\WasteRepository;
use App\Repositories\Waste\WasteRepositoryEloquent;
use App\Repositories\WasteCategory\WasteCategoryRepository;
use App\Repositories\WasteCategory\WasteCategoryRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class
        );

        $this->app->bind(
            WasteCategoryRepository::class,
            WasteCategoryRepositoryEloquent::class
        );

        $this->app->bind(
            WasteRepository::class,
            WasteRepositoryEloquent::class
        );

        $this->app->bind(
            ChallengeRepository::class,
            ChallengeRepositoryEloquent::class
        );

        $this->app->bind(
            CollectPointRepository::class,
            CollectPointRepositoryEloquent::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
