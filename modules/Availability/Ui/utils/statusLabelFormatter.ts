import { MonitoringStatusEnum } from "../types/Availability";

export const statusLabelFormatter = (
    status: MonitoringStatusEnum,
): { label: string; bgColor: string } => {
    switch (status) {
        case MonitoringStatusEnum.ACTIVE:
            return { label: "Ativo", bgColor: "bg-green-600" };
        case MonitoringStatusEnum.PAUSED:
            return { label: "Desativado", bgColor: "bg-red-600" };
        default:
            return { label: "Desconhecido", bgColor: "" };
    }
};
