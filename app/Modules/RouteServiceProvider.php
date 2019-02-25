<?php

namespace App\Modules;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {

        if ($handle = opendir(__DIR__)) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != ".." && is_dir(__DIR__.'/'.$entry)) {

                    if(file_exists(__DIR__.'/'.$entry.'/Routes/web.php'))
                    {
                        Route::group([
                            'namespace' => 'App\Modules\\'.$entry.'\Controllers', 'middleware' => 'web'
                        ], function ($router) use($entry) {
                            require app_path('Modules/'.$entry.'/Routes/web.php');
                        });
                    }
                    
                    
                }
            }
            closedir($handle);
        }
    }
}