<?php

namespace App\Providers;

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
         Blade::directive('rol', function ($rol) {
        return "<?php if(auth()->check() && auth()->user()->role && auth()->user()->role->nombre === $rol): ?>";
    });

        Blade::directive('endrol', function () {
        return "<?php endif; ?>";
    });
    
    }
}
