<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Modules\Availability\Domain\ValueObjects\MonitoringStatusEnum;
use Modules\Availability\Infrastructure\Jobs\CheckMonitorUptimeJob;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    MonitorModel::where(
        'monitoring_status',
        MonitoringStatusEnum::ACTIVE
    )
        ->pluck('id')
        ->each(
            fn($id) =>
            CheckMonitorUptimeJob::dispatch($id)
        );
})->everyMinute();