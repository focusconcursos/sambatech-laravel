<?php

namespace FocusConcursos\SambatechLaravel;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;


class SambatechServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->setupConfig();
    }

    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/sambatech.php');

        $this->publishes([
            $source => config_path('sambatech.php')
        ]);

        $this->mergeConfigFrom($source, 'sambatech');
    }

    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    protected function registerFactory()
    {
        $this->app->singleton('sambatech.factory', function () {
            return new SambatechFactory();
        });

        $this->app->alias('sambatech.factory', SambatechFactory::class);
    }

    protected function registerManager()
    {
        $this->app->singleton('sambatech', function (Container $app) {
            $config = $app['config'];
            $factory = $app['sambatech.factory'];

            return new SambatechManager($config, $factory);
        });

        $this->app->alias('sambatech', SambatechManager::class);
    }

    protected function registerBindings()
    {
        $this->app->bind('sambatech.connection', function (Container $app) {
            $manager = $app['sambatech'];

            return $manager->connection();
        });

        $this->app->alias('sambatech.connection', Sambatech::class);
    }

    public function provides(): array
    {
        return [
            'sambatech',
            'sambatech.factory',
            'sambatech.connection',
        ];
    }
}
