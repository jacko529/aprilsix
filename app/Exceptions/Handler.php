<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        AuthenticationException::class,
        AuthorizationException::class,
        ModelNotFoundException::class,
        RouteNotFoundException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception)
    {
dd($exception);
        if($exception instanceof HttpExceptionInterface) {

            return new JsonResponse(['error' => $exception->getMessage()], $exception->getStatusCode());

        } else if($exception instanceof AuthenticationException) {

            return new JsonResponse((object) [], 401);

        } else if($exception instanceof AuthorizationException) {

            return new JsonResponse((object) [], 401);

        } else if($exception instanceof ModelNotFoundException) {

            return new JsonResponse((object) [], 404);

        } else if ($exception instanceof RouteNotFoundException) {

            return new JsonResponse((object) [], 404);

        } else {

            if (Config::get("app.env") === "local" && $request->wantsJson()) {

                return new JsonResponse(['error' => $exception->getMessage()], 500);

            }

            else {

                return new JsonResponse([], 500);

            }

        }

    }
}
