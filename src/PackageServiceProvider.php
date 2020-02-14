<?php

namespace LaPress\BlogFront;

use Illuminate\Support\ServiceProvider;
use LaPress\BlogFront\Commands\ConfigureCommand;
use LaPress\BlogFront\Commands\InstallCommand;
use LaPress\BlogFront\Commands\WordpressUpdateCommand;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class PackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            WordpressUpdateCommand::class,
            InstallCommand::class,
            ConfigureCommand::class
        ]);
    }
}
