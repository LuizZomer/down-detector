<?php

namespace Modules\Availability\Application\UseCases;

use App\Shared\Domain\Services\HttpClientInterface;
use DateTimeImmutable;
use Exception;
use Http;
use Modules\Availability\Application\Dto\UpdateMonitorData;
use Modules\Availability\Domain\Entity\UptimeCheck;
use Modules\Availability\Domain\Repositories\MonitorRepositoryInterface;
use Modules\Availability\Domain\ValueObjects\CheckStatusEnum;

class CheckUptimeUseCase
{
    public function __construct(
        private MonitorRepositoryInterface $repository,
        private HttpClientInterface $httpClient
    ) {
    }

    public function execute(int $monitorId)
    {
        $monitor = $this->repository->getById($monitorId);

        if (!$monitor || !$monitor->isActive()) {
            return;
        }

        $startTime = microtime(true);

        try {
            $response = $this->httpClient->get($monitor->url);

            \Log::Debug("response", [$response]);

            $duration = (int) ((microtime(true) - $startTime) * 1000);

            $uptimeCheck = new UptimeCheck(
                responseTimeMs: $duration,
                status: $response->isOk() ? CheckStatusEnum::UP : CheckStatusEnum::DOWN,
                httpStatusCode: $response->getStatusCode(),
                reason: null,
                monitorId: $monitor->id,
                createdAt: new DateTimeImmutable()
            );
        } catch (Exception $e) {
            $uptimeCheck = new UptimeCheck(
                responseTimeMs: 0,
                status: CheckStatusEnum::DOWN,
                httpStatusCode: null,
                reason: $e->getMessage(),
                monitorId: $monitor->id,
                createdAt: new DateTimeImmutable()
            );
        }

        $this->repository->createUptime($uptimeCheck);
        $this->repository->update($monitorId, new UpdateMonitorData(
            lastCheckedAt: new DateTimeImmutable(),
            lastCheckStatus: $uptimeCheck->status,
            lastResponseTimeMs: $uptimeCheck->responseTimeMs
        ));
    }
}