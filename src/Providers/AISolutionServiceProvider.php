<?php

declare(strict_types=1);

use NNovosad19\AISolition\Providers\AISolutionProvider;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository;

class AISolutionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Публикация конфигурации
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('config.php'),
        ], 'config');
    }

    public function register(): void
    {
        // Регистрация конфигурации
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'aisolution'
        );

        $this->app->bind(ClientInterface::class, Client::class);

        app(SolutionProviderRepository::class)
            ->registerSolutionProvider(AISolutionProvider::class);
    }
}