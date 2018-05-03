<?php

namespace App\Exceptions;

use Exception;
use Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        // only report errors to rollbar if it's configured and marked as
        // "should report"
        if ( config('services.rollbar.access_token') && $this->shouldReport($exception) ) {
          \Log::error($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ( $request->route()->getAction()['middleware'] == 'api' ) {
          $response = [];

          if ( config('app.debug') ) {
            $response['debug'] = class_basename( $exception ) . ' in ' . basename( $exception->getFile() ) . ' line ' . $exception->getLine() . ': ' . $exception->getMessage();
          }

          switch ( get_class($exception) ) {
            case 'Illuminate\Validation\ValidationException':
              $response['message'] = 'Validation Error';
              $response['details'] = $exception->validator->errors()->all();
              $response['code'] = 400;
              break;
            case 'Illuminate\Auth\Access\AuthorizationException':
            case 'Illuminate\Auth\AuthenticationException':
              $response['message'] = 'Unauthorized';
              $response['details'] = NULL;
              $response['code'] = 401;
              break;
            case 'Illuminate\Database\Eloquent\ModelNotFoundException':
            case 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException':
              $response['message'] = 'Not Found';
              $response['details'] = NULL;
              $response['code'] = 404;
              break;
            default:
              $response['message'] = 'Internal Server Error';
              $response['details'] = NULL;
              $response['code'] = 500;
              break;
          }

          return Response::json($response, $response['code']);
        } else {
          return parent::render($request, $exception);
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
