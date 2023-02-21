<?php

namespace App\Providers;

use App\Repositories\ApiBasedStarWarsRepository;
use App\Repositories\StarWarsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(StarWarsRepository::class, function(){
            return ApiBasedStarWarsRepository::instance();
        });
    }
}
