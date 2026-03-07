<?php

    namespace App\Actions\Payment;

    class CreatePaymentIntentAction {

        public function __construct(
            private PaymentIntentService $service,
        ) {}
        public function execute(CreatePaymentData $dto): Payment {
            return $this->service->createPaymentIntent($dto);
        }
    }