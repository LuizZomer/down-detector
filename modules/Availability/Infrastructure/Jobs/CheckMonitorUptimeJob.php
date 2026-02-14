<?php

namespace Modules\Availability\Infrastructure\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Modules\Availability\Application\UseCases\CheckUptimeUseCase;
use Modules\Availability\Domain\ValueObjects\MonitoringStatusEnum;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;

class CheckMonitorUptimeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 15;

    public function __construct(
        private readonly int $monitorId
    ) {
        $this->onQueue('uptime');
    }

    public function middleware(): array
    {
        return [
            (new WithoutOverlapping($this->monitorId))->expireAfter(30)
        ];
    }

    public function handle(CheckUptimeUseCase $useCase)
    {
        $useCase->execute($this->monitorId);

        $monitor = MonitorModel::find($this->monitorId);

        if ($monitor && $monitor->monitoring_status === MonitoringStatusEnum::ACTIVE) {
            CheckMonitorUptimeJob::dispatch($this->monitorId)
                ->delay(now()->addSeconds($monitor->frequency_seconds));
        }
    }
}