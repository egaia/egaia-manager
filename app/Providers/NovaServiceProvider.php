<?php

namespace App\Providers;

use App\Nova\Admin;
use App\Nova\Category;
use App\Nova\Challenge;
use App\Nova\ChallengeUser;
use App\Nova\CollectPoint;
use App\Nova\Contact;
use App\Nova\Post;
use App\Nova\TrashCan;
use App\Nova\User;
use App\Nova\Waste;
use App\Nova\WasteCategory;
use App\Nova\WastePart;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new CollapsibleResourceManager([
                'navigation' => [
                    TopLevelResource::make([
                        'label' => 'Tri',
                        'resources' => [
                            WasteCategory::class,
                            Waste::class,
                            WastePart::class,
                            TrashCan::class,
                            CollectPoint::class
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Défis',
                        'resources' => [
                            Challenge::class,
                            ChallengeUser::class
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Blog',
                        'resources' => [
                            Category::class,
                            Post::class
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Utilisateurs',
                        'resources' => [
                            Admin::class,
                            User::class,
                            Contact::class
                        ]
                    ])
                ]
            ])
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
