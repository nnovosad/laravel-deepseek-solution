<?php

declare(strict_types=1);

use NNovosad19\AISolution\Services\AISolution;

return [
    /*
    |--------------------------------------------------------------------------
    | Enable ignition solution
    |--------------------------------------------------------------------------
    |
    | Enable or disable solution for ignition
    |
    */
    'enable_ignition_solution' => env('AI_IGNITION_SOLUTION_ENABLE', true),

    /*
    |--------------------------------------------------------------------------
    | Enable exception solution
    |--------------------------------------------------------------------------
    |
    | Enable or disable solution for exception
    |
    */
    'enable_exception_solution' => env('AI_EXCEPTION_SOLUTION_ENABLE', true),

    /*
    |--------------------------------------------------------------------------
    | Deepseek model
    |--------------------------------------------------------------------------
    |
    | Specifies the Deepseek model to be used.
    |
    */
    'model' => env('AI_SOLUTION_DEEPSEEK_MODEL', 'deepseek-chat'),


    /*
    |--------------------------------------------------------------------------
    | Deepseek temperature
    |--------------------------------------------------------------------------
    |
    | Controls the degree of randomness of the model's responses.
    |
    */
    'temperature' => env('AI_SOLUTION_DEEPSEEK_TEMPERATURE', 1.3),

    /*
    |--------------------------------------------------------------------------
    | Cache lifetime
    |--------------------------------------------------------------------------
    |
    | Determines the cache lifetime for Deepseek responses.
    |
    */
    'cache_ttl' => env('AI_SOLUTION_DEEPSEEK_CACHE_TTL', 3600),
];