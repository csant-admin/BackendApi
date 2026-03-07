<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            RepositoryAccountInterface::class,
            RepositoryAccount::class
        );

        $this->app->bind(ClockInterface::class, SystemClock::class);

        $this->app->bind(AuditLoggerInterface::class, DatabaseAuditLogger::class);

        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

        $this->app->bind(QrphPayloadBuilderInterface::class, EmvQrphPayloadBuilder::class);
        $this->app->bind(QrPaymentGatewayInterface::class, QrphEmvCoGateway::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         
    }
}
