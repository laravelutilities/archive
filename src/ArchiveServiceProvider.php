<?php

namespace LaravelUtility\Archive;

use \Illuminate\Support\ServiceProvider;
use \LaravelUtility\Archive\Console\Commands\ {
    ArchiveCommand,
    ArchiveSetupCommand
};

/**
 * Description of ArchiveServiceProvider
 *
 * 
 * @author Ankit Vishwakarma <er.ankitvishwakarma@gmail.com>
 * @modified Feb 21, 2019
 */
 
class ArchiveServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/archive.php' => config_path('archive.php'),
        ], 'archive');
    }
    
    public function register()
    {
        $this->app->singleton('archive.run', function () {
            return new ArchiveCommand();
        });
        $this->app->singleton('archive.setup', function () {
            return new ArchiveSetupCommand();
        });
        $this->commands(['archive.run', 'archive.setup']);

        $this->mergeConfigFrom(__DIR__.'/config/archive.php', 'archive');
    }
}
