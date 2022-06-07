<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\System;

class GrocersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('appinfo', function () {
            $system = count(System::get());

            if ($system > 0) {
                return "<?php if (false) { ?>";
            } else {
                return "<?php if (true) { ?>";
            }
        });
      
        Blade::directive('endappinfo', function () {
            return "<?php } ?>";
        });
        
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('M d/y @ h:ma'); ?>";
        });
    }
}
