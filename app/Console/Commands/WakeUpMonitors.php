<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Availability\Domain\ValueObjects\MonitoringStatusEnum;
use Modules\Availability\Infrastructure\Jobs\CheckMonitorUptimeJob;
use Modules\Availability\Infrastructure\Persistence\Eloquent\Model\MonitorModel;

class WakeUpMonitors extends Command
{
    protected $signature = 'monitors:wakeup';

    protected $description = 'Inicia o loop de monitoramento para monitores ativos que estão parados.';

    public function handle()
    {
        $this->info('Iniciando o despertar dos monitores...');

        MonitorModel::where('monitoring_status', MonitoringStatusEnum::ACTIVE)
            ->where(function ($query) {
                $query->whereNull('last_checked_at')
                    ->orWhere('last_checked_at', '<', now()->subMinutes(5));
            })
            ->chunkById(100, function ($monitors) {
                foreach ($monitors as $monitor) {
                    CheckMonitorUptimeJob::dispatch($monitor->id);
                    $this->line("Job disparado para o monitor ID: {$monitor->id}");
                }
            });

        $this->info('Processo concluído!');
    }
}