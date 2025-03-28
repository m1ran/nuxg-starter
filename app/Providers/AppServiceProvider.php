<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserLinkRepository;
use App\Services\GameServiceInterface;
use App\Services\GameServiceFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserLinkRepository::class, function ($app) {
            return new UserLinkRepository();
        });

        $this->app->singleton(GameServiceInterface::class, function ($app) {
            return GameServiceFactory::create(env('APP_GAME_SERVICE'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
