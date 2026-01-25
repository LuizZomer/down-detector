export enum MonitoringStatusEnum {
    ACTIVE = "active",
    PAUSED = "paused",
}

export enum CheckStatusEnum {
    UP = "up",
    DOWN = "down",
    MAINTENANCE = "maintenance",
}

export interface IAvailability {
    id: number;
    name: string;
    url: string;

    errorSendEmail: boolean;

    lastCheckStatus: CheckStatusEnum | null;
    lastCheckedAt: string | null;

    lastResponseTimeMs: number | null;
    frequencySeconds: number;
    monitoringStatus: MonitoringStatusEnum;

    userId: number;

    createdAt: string | null;
    updatedAt: string | null;
}
