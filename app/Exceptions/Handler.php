<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\JsonResponseTrait;
use Throwable;

class Handler extends ExceptionHandler
{
    use JsonResponseTrait;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e) {

            if($e instanceof NotFoundHttpException) {

                if(request()->is('api/*'))
                    return $this->modelNotFound();

                if(request()->is('dashboard/*'))
                    abort(404);

            }

        });
    }
}
