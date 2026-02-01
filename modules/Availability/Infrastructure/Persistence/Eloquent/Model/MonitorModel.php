<?php

namespace Modules\Availability\Infrastructure\Persistence\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Availability\Domain\ValueObjects\CheckStatusEnum;
use Modules\Availability\Domain\ValueObjects\MonitoringStatusEnum;
use Modules\Users\Domain\Entities\User;

class MonitorModel extends Model
{
    use SoftDeletes;

    protected $table = 'monitors';

    protected $fillable = [
        'name',
        'url',
        'error_send_email',
        'last_checked_at',
        'last_check_status',
        'last_response_time_ms',
        'frequency_seconds',
        'monitoring_status',
        'user_id',
    ];

    protected $casts = [
        'error_send_email' => 'boolean',
        'last_checked_at' => 'datetime',
        'last_response_time_ms' => 'integer',
        'frequency_seconds' => 'integer',
        'last_check_status' => CheckStatusEnum::class,
        'monitoring_status' => MonitoringStatusEnum::class,
    ];

    protected $hidden = ['deleted_at'];

    protected static function booted(): void
    {
        static::addGlobalScope('ignore_deleted', function (Builder $builder) {
            $builder->whereNull('deleted_at');
        });
    }

    /* ======================
     | Relationships
     ====================== */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function uptimeChecks(): HasMany
    {
        return $this->hasMany(UptimeCheckModel::class);
    }

    /* ======================
     | Helpers / Domain Logic
     ====================== */

    public function isActive(): bool
    {
        return $this->monitoring_status === MonitoringStatusEnum::ACTIVE;
    }

    public function markAsChecked(
        CheckStatusEnum $status,
        ?int $responseTimeMs = null
    ): void {
        $this->update([
            'last_checked_at' => now(),
            'last_check_status' => $status,
            'last_response_time_ms' => $responseTimeMs,
        ]);
    }
}
