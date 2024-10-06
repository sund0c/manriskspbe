<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException as ExceptionsUnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'html.purifier' => \App\Http\Middleware\HtmlPurifierMiddleware::class,
            'no.cache' => \App\Http\Middleware\NoCache::class,

        ]);
    })
    // ->withExceptions(function (Exceptions $exceptions) {
    //     $exceptions->render(function (Request $request, Throwable $exception) {
    //         if ($exception instanceof UnauthorizedException) {
    //             return response()->view('errors.index', ['exception' => $exception->getMessage()], 403);
    //         }

    //         // Tangani pengecualian lain dengan handler default
    //         return null;//parent::render($request, $exception);
    //         //return (new \Illuminate\Foundation\Exceptions\Handler(app()))->render($request, $exception);
    //     });
    // })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ExceptionsUnauthorizedException $e, Request $request) {
            return response()->view('errors.index', ['exception'=> $e->getMessage()]);
        });
    })
    ->create();


