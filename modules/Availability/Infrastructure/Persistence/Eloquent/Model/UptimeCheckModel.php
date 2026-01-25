<?php

namespace Modules\Availability\Infrastructure\Persistence\Eloquent\Model;

use App\Enums\CheckStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UptimeCheckModel extends Model
{
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
        'status' => CheckStatus::class,
        'created_at' => 'datetime',
    ];

    /* ======================
     | Relationships
     ====================== */

    public function monitor(): BelongsTo
    {
        return $this->belongsTo(Monitor::class);
    }
}
