<?php

namespace Modules\Availability\Infrastructure\Persistence\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Availability\Domain\ValueObjects\CheckStatusEnum;

class UptimeCheckModel extends Model
{
    public $table = 'uptime_checks';
    public $timestamps = false;

    protected $fillable = [
        'response_time_ms',
        'status',
        'http_status_code',
        'reason',
        'monitor_id',
        'created_at',
    ];

    protected $casts = [
        'response_time_ms' => 'integer',
        'http_status_code' => 'integer',
        'status' => CheckStatusEnum::class,
        'created_at' => 'datetime',
    ];

    /* ======================
     | Relationships
     ====================== */

    public function monitor(): BelongsTo
    {
        return $this->belongsTo(MonitorModel::class);
    }
}
