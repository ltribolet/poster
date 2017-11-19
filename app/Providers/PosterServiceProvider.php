<?php

namespace App\Providers;

use App\Service\PictureService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class PosterServiceProvider extends ServiceProvider
{
    /**
     * Loading services will be deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Service\PictureService',
            function ($app) {
                return new PictureService();
            }
        );

        $this->app->singleton(
            'League\Glide\Server',
            function ($app) {
                /** @var \Illuminate\Contracts\Filesystem\Filesystem $fileSystem */
                $fileSystem = $this->app->make('Illuminate\Contracts\Filesystem\Filesystem');

                return ServerFactory::create(
                    [
                        'response' => new LaravelResponseFactory(app('request')),
                        'source' => $fileSystem->getDriver(),
                        'cache' => $fileSystem->getDriver(),
                        'source_path_prefix' => 'public/img',
                        'cache_path_prefix' => 'public/img/.cache',
                        'base_url' => 'img',
                        'driver' => 'imagick',
                        'presets' => [
                            'small' => [
                                'w' => 200,
                                'h' => 200,
                                'fit' => 'crop',
                            ],
                            'small@2x' => [
                                'w' => 400,
                                'h' => 400,
                                'fit' => 'crop',
                            ],
                            'medium' => [
                                'w' => 600,
                                'h' => 400,
                                'fit' => 'crop',
                            ],
                        ],
                    ]
                );
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [PictureService::class];
    }
}
