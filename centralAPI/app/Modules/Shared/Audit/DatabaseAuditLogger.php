<?php
// app/Modules/InvestmentApp/Shared/Audit/DatabaseAuditLogger.php
namespace App\Modules\Shared\Audit;

use App\Models\AuditLog;

class DatabaseAuditLogger implements AuditLoggerInterface {
    public function log(string $actorType, int $actorId, string $action, array $meta = []): void {
        AuditLog::create([
            'actor_type' => $actorType,
            'actor_id'   => $actorId,
            'action'     => $action,
            'meta'       => $meta,
        ]);
    }
}
