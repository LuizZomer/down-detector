<?php

namespace Modules\Availability\Infrastructure\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Modules\Availability\Application\UseCases\CheckUptimeUseCase;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;

class CheckMonitorUptimeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(
        private readonly int $monitorId
    ) {
        $this->onQueue('uptime');
    }

    public function middleware(): array
    {
        return [
            new WithoutOverlapping($this->monitorId)
        ];
    }

    public function handle(CheckUptimeUseCase $useCase)
    {
        \Log::info("Checking uptime for monitor ID: {$this->monitorId}");

        $useCase->execute($this->monitorId);

        $monitor = MonitorModel::find($this->monitorId);

        CheckMonitorUptimeJob::dispatch($this->monitorId)
            ->delay(now()->addSeconds($monitor->frequency_seconds));
    }
}