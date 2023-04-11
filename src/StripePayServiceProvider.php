<?php
/**
 * Date 10/04/2023
 *
 * @author   Simon Siva <simonsiva13@gmail.com>
 */

namespace Ssiva\LaravelStripe;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class StripePayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        Route::prefix('api')
            ->middleware('api')
            ->namespace('Ssiva\LaravelStripe\Controllers')
            ->group(__DIR__.'/routes/api.php');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        //
    }
}
