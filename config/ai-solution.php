<?php

declare(strict_types=1);

use NNovosad19\AISolution\Services\AISolution;

return [
    'model' => env('AI_SOLUTION_DEEPSEEK_MODEL', 'deepseek-chat'),
    'temperature' => env('AI_SOLUTION_DEEPSEEK_TEMPERATURE', 1.3),
    'cache_ttl' => env('AI_SOLUTION_DEEPSEEK_CACHE_TTL', 3600),
];