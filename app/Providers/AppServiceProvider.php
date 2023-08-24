<?php

namespace App\Providers;

use App\View\Components\Forms\Input;
use App\View\Components\Forms\Select;
use App\View\Components\Forms\Textarea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('base-input', Input::class);
        Blade::component('base-select', Select::class);
        Blade::component('base-textarea', Textarea::class);

        Model::preventLazyLoading(App::isLocal());
        Paginator::useBootstrapFive();
    }
}
