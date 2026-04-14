<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Overtime;

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
  view()->composer('*', function ($view) {

        $lembur_pending = Overtime::where('status', 'pending')->count();

        $view->with('lembur_pending', $lembur_pending);
    });
}
}
