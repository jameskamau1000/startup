<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Handle database connection errors and show maintenance page
        if ($exception instanceof \PDOException || 
            $exception instanceof \Illuminate\Database\QueryException ||
            $exception instanceof \Illuminate\Database\ConnectionException) {
            return response()->view('errors.503', [], 503);
        }

        // Handle cases where database is not accessible
        if (strpos($exception->getMessage(), 'SQLSTATE') !== false ||
            strpos($exception->getMessage(), 'Connection refused') !== false ||
            strpos($exception->getMessage(), 'Access denied') !== false ||
            strpos($exception->getMessage(), 'Unknown database') !== false ||
            strpos($exception->getMessage(), 'No connection could be made') !== false) {
            return response()->view('errors.503', [], 503);
        }

        return parent::render($request, $exception);
    }
}
