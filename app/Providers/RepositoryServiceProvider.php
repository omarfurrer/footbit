<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\Repositories\UsersRepository::class,
                         \App\Repositories\Eloquent\UsersRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\PlayersRepository::class,
                         \App\Repositories\Eloquent\PlayersRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\RefereesRepository::class,
                         \App\Repositories\Eloquent\RefereesRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\TeamsRepository::class,
                         \App\Repositories\Eloquent\TeamsRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\TournamentsRepository::class,
                         \App\Repositories\Eloquent\TournamentsRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\MatchesRepository::class,
                         \App\Repositories\Eloquent\MatchesRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\MatchActionesRepository::class,
                         \App\Repositories\Eloquent\MatchActionesRepositoryEloquent::class);
        //:end-bindings:
    }

}
