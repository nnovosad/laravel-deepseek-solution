<?php

declare(strict_types=1);

namespace NNovosad19\AISolution\Providers;

use NNovosad19\AISolution\Providers\AISolutionProvider;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;
use Spatie\ErrorSolutions\SolutionProviderRepository;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository as SolutionProviderRepositoryContract;

class AISolutionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(dirname(__DIR__, 2) . '/resources/views', 'ai-solution');
    }

    public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);

        $this->app->bind(
            SolutionProviderRepositoryContract::class,
            SolutionProviderRepository::class
        );

        $this->app->make(SolutionProviderRepository::class)
            ->registerSolutionProvider(AISolutionProvider::class);
    }
}
