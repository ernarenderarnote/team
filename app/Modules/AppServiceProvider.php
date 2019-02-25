<?php

namespace App\Modules;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if ($handle = opendir(__DIR__)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && is_dir(__DIR__.'/'.$entry)) {
                    $this->loadViewsFrom( base_path().'/app/Modules/'.$entry.'/Views', $entry);
                }
            }
            closedir($handle);
        }

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}
