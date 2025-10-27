<?php

namespace Sandalanka\ErrorReporter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ErrorReporterServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Merge default config
        $this->mergeConfigFrom(__DIR__ . '/../config/error-reporter.php', 'error-reporter');
    }

    public function boot()
    {
        // Publish config and mail view
        $this->publishes([
            __DIR__ . '/../config/error-reporter.php' => config_path('error-reporter.php'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/error-reporter'),
        ], 'error-reporter');

        // Register global exception listener
        app('Illuminate\Contracts\Debug\ExceptionHandler')->reportable(function (Throwable $e) {
            $this->handleException($e);
        });
    }

    protected function handleException(Throwable $e)
    {
        $adminEmail = env('ADMIN_MAIL_ADDRESS');

        if (!$adminEmail) {
            Log::warning('ADMIN_MAIL_ADDRESS not set in .env');
            return;
        }

        $errorData = [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ];

        // Log it
        Log::error("Exception: {$e->getMessage()} in {$e->getFile()} line {$e->getLine()}");

        // Send mail
        Mail::send('error-reporter::error_mail', $errorData, function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                    ->subject('⚠️ Exception Detected in Application');
        });
    }
}
