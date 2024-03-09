<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\OAuthServerException as ExceptionsOAuthServerException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;



class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        $this->renderable(function (Throwable $th, Request $request) {
            if ($request->is('api/*')) {
                Log::error($th);
                if ($th instanceof ValidationException) {
                    // info('test1111');
                    return (new Controller())->errorResponse(
                        [], 400, $th->getMessage()
                    );
                }

                if ($th instanceof NotFoundHttpException) {
                    $message = $th->getMessage();

                    return (new Controller())->errorResponse(
                        [], 404, $th->getMessage()
                    );
                }

                if ($th instanceof ThrottleRequestsException) {
                    return (new Controller())->errorResponse(
                        [], 429, $th->getMessage()
                    );
                }


                if ($th instanceof AuthenticationException) {
                    return (new Controller())->errorResponse(
                        [], 401, $th->getMessage()
                    );
                }

                if ($th instanceof AccessDeniedHttpException) {
                    return (new Controller())->errorResponse(
                        [], 403, $th->getMessage()
                    );
                }


                return (new Controller())->errorResponse(
                    [], 500, $th->getMessage()
                );
                }

        }
    );
    }
      

}
