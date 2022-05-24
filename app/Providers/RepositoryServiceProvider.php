<?php


namespace App\Providers;

use App\Repositories\Challenge\ChallengeRepository;
use App\Repositories\Challenge\ChallengeRepositoryEloquent;
use App\Repositories\ChallengeUser\ChallengeUserRepository;
use App\Repositories\ChallengeUser\ChallengeUserRepositoryEloquent;
use App\Repositories\CollectPoint\CollectPointRepository;
use App\Repositories\CollectPoint\CollectPointRepositoryEloquent;
use App\Repositories\Promotion\PromotionRepository;
use App\Repositories\Promotion\PromotionRepositoryEloquent;
use App\Repositories\PromotionUser\PromotionUserRepository;
use App\Repositories\PromotionUser\PromotionUserRepositoryEloquent;
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

        $this->app->bind(
            ChallengeUserRepository::class,
            ChallengeUserRepositoryEloquent::class,
        );

        $this->app->bind(
            PromotionUserRepository::class,
            PromotionUserRepositoryEloquent::class,
        );

        $this->app->bind(
            PromotionRepository::class,
            PromotionRepositoryEloquent::class,
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
