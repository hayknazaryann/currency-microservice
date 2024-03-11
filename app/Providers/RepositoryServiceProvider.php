<?php

namespace App\Providers;

use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Interfaces\CurrencyInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $bindings = [
        CurrencyInterface::class => CurrencyRepository::class
    ];

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
        //
    }
}
