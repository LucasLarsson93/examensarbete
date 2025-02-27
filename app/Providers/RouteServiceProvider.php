<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    /**
     * Define your route model bindings, pattern filters, and other route services.
     */

    /**
     * Register the route service provider.
     */
    public function register(): void
    {
        //
    }

    /**
     * Define the routes for your application.
     *
     * @return void
     */
    public function map()
    {
        // Example: Load your web routes
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}
