<?php

declare(strict_types=1);

namespace NNovosad19\AISolution\Providers;

use NNovosad19\AISolution\Providers\AISolutionProvider;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository;
use Spatie\ErrorSolutions\SolutionProviders\SolutionProviderRepository as SpatieSolutionProviderRepository;

class AISolutionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        // Привязка интерфейса HTTP-клиента
        $this->app->bind(ClientInterface::class, Client::class);

        // Привязка интерфейса SolutionProviderRepository к реализации
        $this->app->bind(
            SolutionProviderRepository::class,
            SpatieSolutionProviderRepository::class
        );

        // Регистрация провайдера решений
        $this->app->make(SolutionProviderRepository::class)
            ->registerSolutionProvider(AISolutionProvider::class);
    }
}