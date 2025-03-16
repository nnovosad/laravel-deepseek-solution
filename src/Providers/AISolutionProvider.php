<?php

declare(strict_types=1);

namespace NNovosad19\AISolution\Providers;

use NNovosad19\AISolition\Services\AISolution;
use Spatie\Ignition\Contracts\HasSolutionsForThrowable;
use Throwable;

class AISolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        return true;
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [new AISolution($throwable)];
    }
}