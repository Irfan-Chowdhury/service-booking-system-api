<?php

use App\Exceptions\Handler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Illuminate\Validation\ValidationException $e, $request) {
            return response()->json([
                'statusCode' => 422,
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $e->errors(),
            ], 422);
        });

        // Authentication errors
        $exceptions->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            return response()->json([
                'statusCode' => 401,
                'success' => false,
                'message' => 'Authentication required',
                'errors'  => ['auth' => ['You must be logged in to access this resource.']],
            ], 401);
        });

        // Model not found errors
        $exceptions->renderable(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, $request) {
            return response()->json([
                'statusCode' => 404,
                'success' => false,
                'message' => 'Resource not found',
                'errors'  => ['resource' => ['The requested resource does not exist.']],
            ], 404);
        });

        // All other errors
        $exceptions->renderable(function (Throwable $e, $request) {
            return response()->json([
                'statusCode' => 500,
                'success' => false,
                'message' => 'Server Error',
                'errors'  => [$e->getMessage()],
            ], 500);
        });

    })->create();
