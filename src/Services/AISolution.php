<?php

declare(strict_types=1);

namespace NNovosad19\AISolution\Services;

use Deepseek\DeepseekClient;
use Illuminate\Support\Facades\Cache;
use Spatie\Backtrace\Backtrace;
use Spatie\Backtrace\Frame;
use Spatie\ErrorSolutions\Contracts\Solution;
use Throwable;

class AISolution implements Solution
{
    private const string DEEPSEEK_MODEL = 'deepseek-chat';
    private const float DEEPSEEK_TEMPERATURE = 1.3;

    protected string $solution;
    protected DeepseekClient $deepseek;
    protected string $cacheKey;

    public function __construct(protected Throwable $throwable)
    {
        $this->deepseek = app('DeepseekClient');
        $this->cacheKey = $this->generateCacheKey($throwable);

        $this->solution = $this->getSolutionFromCache() ?? $this->fetchAndCacheSolution();
    }

    protected function generateCacheKey(Throwable $throwable): string
    {
        return md5(sprintf('solution_%s', $throwable->getTraceAsString()));
    }

    protected function getSolutionFromCache(): ?string
    {
        return Cache::get($this->cacheKey);
    }

    protected function fetchAndCacheSolution(): string
    {
        $response = $this->deepseek
            ->query($this->generatePrompt($this->throwable))
            ->withModel(config('ai-solution.model'))
            ->setTemperature(config('temperature'))
            ->run();

        $response = $this->decodeResponse($response);

        $this->validateResponse($response);

        return Cache::remember(
            $this->cacheKey,
            config('ai-solution.cache_ttl'),
            function () use ($response) {
                return $response['choices'][0]['message']['content'];
            }
        );
    }

    protected function decodeResponse(string $response): array
    {
        $decodedResponse = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Failed to decode JSON response from Deepseek API');
        }

        return $decodedResponse;
    }

    protected function validateResponse(array $response): void
    {
        if (!isset($response['choices'][0]['message']['content'])) {
            throw new \RuntimeException('Invalid response from Deepseek API');
        }
    }

    public function getSolutionTitle(): string
    {
        return 'AI Generated Solution';
    }

    public function getSolutionDescription(): string
    {
        return $this->solution;
    }

    public function getDocumentationLinks(): array
    {
        return [];
    }

    protected function generatePrompt(Throwable $throwable): string
    {
        $applicationFrame = $this->getApplicationFrame($throwable);

        if (!$applicationFrame) {
            throw new \RuntimeException('Unable to determine application frame');
        }

        $snippet = $applicationFrame->getSnippet(15);

        return (string)view('prompts.solution', [
            'snippet' => collect($snippet)->map(fn ($line, $number) => $number .' '.$line)->join(PHP_EOL),
            'file' => $applicationFrame->file,
            'line' => $applicationFrame->lineNumber,
            'exception' => $throwable->getMessage(),
        ]);
    }

    protected function getApplicationFrame(Throwable $throwable): ?Frame
    {
        $backtrace = Backtrace::createForThrowable($throwable)->applicationPath(base_path());
        $frames = $backtrace->frames();
        return $frames[$backtrace->firstApplicationFrameIndex()] ?? null;
    }
}
