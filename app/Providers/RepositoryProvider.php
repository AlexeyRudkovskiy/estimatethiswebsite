<?php

namespace App\Providers;

use App\Contracts\Repositories\OrganisationRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\OrganisationRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrganisationRepositoryContract::class, OrganisationRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
