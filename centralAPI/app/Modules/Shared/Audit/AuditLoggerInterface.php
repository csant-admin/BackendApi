<?php
// app/Modules/InvestmentApp/Shared/Audit/AuditLoggerInterface.php
namespace App\Modules\Shared\Audit;

interface AuditLoggerInterface {
    public function log(string $actorType, int $actorId, string $action, array $meta = []): void;
}
