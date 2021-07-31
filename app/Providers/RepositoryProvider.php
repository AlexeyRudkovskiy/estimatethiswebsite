<?php

namespace App\Providers;

use App\Contracts\Repositories\OrganisationRepositoryContract;
use App\Repositories\OrganisationRepository;
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
