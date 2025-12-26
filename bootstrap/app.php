<?php

use App\Exceptions\ApiException;
use Illuminate\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $exception) {
            if ($exception instanceof NotFoundHttpException) {
                $input = [
                    'success' => false,
                    'message' => __('messages.public.error.not_exist', ['pattern' => 'مسیر']),
                    'data' => []
                ];
                return response($input, 401);
            }

            if ($exception instanceof AuthenticationException) {
                $input = [
                    'success' => false,
                    'message' => __('messages.public.error.access_denied'),
                    'data' => []
                ];
                return response($input, 401);
            }

            if ($exception instanceof QueryException) {

                $message = __('messages.public.error.internal_server_error');
                if ($exception->errorInfo[1] == 1062) {
                    preg_match('/Duplicate entry \'(.*)\' for key \'(.*?)\'/', $exception->getMessage(), $matches);
                    $message = __('messages.public.error.unique', ['pattern' => $matches[2]]);
                }

                $input = [
                    'success' => false,
                    'message' => $message,
                    'data' => [$exception->errorInfo]
                ];
                return response($input, 500);
            }

            if ($exception instanceof ModelNotFoundException) {
                $input = [
                    'success' => false,
                    'message' => 'اطلاعات یافت نشد',
                    'data' => [$exception->getMessage()]
                ];
                return $this->showResponse($input, 404);
            }

            if ($exception instanceof ValidationException) {
                $input = [
                    'success' => false,
                    'message' => __('messages.public.error.validation'), //$exception->getMessage(),
                    'data' => ['errors' =>  $exception->errors()]
                ];

                return response($input, 422);
            }

            if ($exception instanceof ApiException) {

                $input = [
                    'success' => false,
                    'message' => __('messages.public.error.api'),
                    'data' =>  $exception->getErrors()
                ];

                return response($input, 500);
            }

            if ($exception instanceof AccessDeniedException) {
                $input = [
                    'success' => false,
                    'message' => __('messages.public.error.access_denied'),
                    'errors' => [],
                    'data' => []
                ];
                return response($input, 403);
            }

            if ($exception instanceof \InvalidArgumentException) {
                // dd($exception->getMessage());
                $message = $exception->getMessage();
                $input = [
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'data' => []
                ];
                return response($input, 422);
            }

            $input = [
                'success' => false,
                'message' => __('messages.public.error.internal_server_error'),
                'data' => [
                    'errors' => [
                        'message' => $exception->getMessage(),
                    ],
                    'trace' => $exception->getTrace()
                ],
            ];

            if (!env('APP_DEBUG')) {
                $input['data'] = [];
            }
            return response($input, 500);
        });
    })->create();
