<?php
namespace App\Repositories\Payment\Contracts;
use App\Models\Payment;

interface PaymentRepositoryInterface
{
    public function create(array $data): Payment;
    public function findById(int $id): Payment;
    public function findByGatewayReference(string $gatewayReference): Payment;

    public function markPaid(int $id, array $meta = []): void;
    public function markFailed(int $id, string $reason): void;
}
