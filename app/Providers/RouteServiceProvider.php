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
    protected $namespace = 'App\\Http\\Controllers';
    /**
     * Define your route model bindings, pattern filters, and other route services.
     *
     * @return void
     */

    /**
     * Register the route service provider.
     *
     * @return void
     */
    public function register()
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
            ->namespace($this->namespace)
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
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
