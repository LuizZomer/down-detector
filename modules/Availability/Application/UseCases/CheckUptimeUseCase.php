<?php

namespace Modules\Availability\Application\UseCases;

use App\Shared\Domain\Services\HttpClientInterface;
use DateTimeImmutable;
use Exception;
use Http;
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

    public function execute(int $monitor)
    {
        $monitor = $this->repository->getById($monitor);

        if (!$monitor || !$monitor->isActive()) {
            return;
        }

        $startTime = microtime(true);

        try {
            $response = Http::get($monitor->url);
            $duration = (int) ((microtime(true) - $startTime) * 1000);

            $uptimeCheck = new UptimeCheck(
                responseTimeMs: $duration,
                status: $response->isOk() ? CheckStatusEnum::UP : CheckStatusEnum::DOWN,
                httpStatusCode: $response->getStatusCode(),
                reason: null,
                monitorId: $monitor->id,
                createdAt: new DateTimeImmutable()
            );

            $this->repository->createUptime($uptimeCheck);

        } catch (Exception $e) {
            $uptimeCheck = new UptimeCheck(
                responseTimeMs: 0,
                status: CheckStatusEnum::DOWN,
                httpStatusCode: null,
                reason: $e->getMessage(),
                monitorId: $monitor->id,
                createdAt: new DateTimeImmutable()
            );

            $this->repository->createUptime($uptimeCheck);
        }
    }
}