<?php

namespace App\Exceptions;

use App\Helpers\Telegram;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Container\Container;
use Throwable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Handler extends ExceptionHandler
{
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

    protected $telegram;

    public function __construct(Container $container, Telegram $telegram) {
        parent::__construct($container);
        $this->telegram = $telegram;
    }

    public function report(Throwable $e) {
        $data = [
            'description' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ];

        $this->telegram->sendMessage((string)view('reports', $data));
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
