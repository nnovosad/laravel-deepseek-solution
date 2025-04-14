<?php

declare(strict_types=1);

namespace NNovosad19\AISolution\Handlers;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use NNovosad19\AISolution\Services\AISolution;
use Symfony\Component\HttpFoundation\Response;

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, \Throwable $e): Response
    {
        $response = parent::render($request, $e);

        if ($response->isServerError()) {
            $original = $response->getOriginalContent();
            if (is_array($original)) {
                $aiSolution = new AISolution($e);

                $original['ai_solution'] = $aiSolution->solution;
                $response->setContent(json_encode($original));
            }
        }

        return $response;
    }
}