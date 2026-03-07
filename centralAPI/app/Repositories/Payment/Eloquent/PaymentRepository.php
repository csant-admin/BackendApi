<?php
namespace App\Repositories\Payment\Eloquent;

use App\Models\Payment;
use App\Modules\InvestmentApp\Payments\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    public function findById(int $id): Payment
    {
        return Payment::findOrFail($id);
    }

    public function findByGatewayReference(string $gatewayReference): Payment
    {
        return Payment::where('gateway_reference', $gatewayReference)->firstOrFail();
    }

    public function markPaid(int $id, array $meta = []): void
    {
        $payment = $this->findById($id);
        $payment->update([
            'status' => 'paid',
            'meta'   => array_merge($payment->meta ?? [], $meta),
        ]);
    }

    public function markFailed(int $id, string $reason): void
    {
        $payment = $this->findById($id);
        $payment->update([
            'status' => 'failed',
            'meta'   => array_merge($payment->meta ?? [], ['fail_reason' => $reason]),
        ]);
    }
}
