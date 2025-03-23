<?php

declare(strict_types=1);

namespace NNovosad19\AISolution\Providers;

use DeepSeek\DeepSeekClient;
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
        $this->publishes([
            dirname(__DIR__, 2) . '/config/ai-solution.php' => config_path('ai-solution.php'),
        ], 'ai-solution');

        $this->loadViewsFrom(
            dirname(__DIR__, 2).'/resources/views',
            'ai-solution',
        );

        if (config('ai-solution.enable')) {
            $this->app->afterResolving(
                SolutionProviderRepository::class,
                function (SolutionProviderRepository $repository) {
                    $repository->registerSolutionProvider(AISolutionProvider::class);
                }
            );
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__, 2) . '/config/ai-solution.php',
            'ai-solution',
        );

        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind('DeepseekClient', DeepseekClient::class);
    }
}
