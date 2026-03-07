<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
       public function __construct(private PaymentService $payments) {}

    public function handle(ValidateQrphCallbackRequest $request)
    {
        $dto = new ValidatePaymentData(
            gatewayReference: $request->gateway_reference,
            paidAmount: (float) $request->paid_amount,
            signature: $request->signature,
            rawPayload: $request->payload,
        );

        $payment = $this->payments->validateAndPost($dto);

        return response()->json([
            'status' => $payment->status,
            'payment_id' => $payment->id,
        ]);
    }
}
