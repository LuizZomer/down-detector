import { router, usePage } from "@inertiajs/react";
import { route } from "ziggy-js";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { useState } from "react";
import { MonitoringStatusEnum } from "../types/Availability";
import { Button } from "@/components/ui/button";
import type { PageProps } from "@/types/page";
import { getQueryParam } from "@/utils/getQueryParam";
import { createClearableSelectHandler } from "@/utils/handleSelectWithClear";

export interface AvailabilityPageProps extends PageProps {
    filters: {
        status?: MonitoringStatusEnum;
    };
}

export const AvailabilityFilterList = () => {
    const initialStatus = getQueryParam(
        "status",
    ) as MonitoringStatusEnum | null;

    const [selectedStatus, setSelectedStatus] =
        useState<MonitoringStatusEnum | null>(initialStatus);

    const handleSubmitFilter = (e: React.FormEvent) => {
        e.preventDefault();

        router.get(route("availability.index"), {
            status: selectedStatus,
        });
    };

    return (
        <form
            onSubmit={handleSubmitFilter}
            className="flex flex-wrap items-end gap-4 rounded-lg border bg-background p-4 shadow-sm"
        >
            <div className="flex flex-col gap-1">
                <label className="text-sm font-medium">Status</label>
                <Select
                    value={selectedStatus || ""}
                    onValueChange={(value) =>
                        createClearableSelectHandler(
                            setSelectedStatus,
                            "clear",
                            value as MonitoringStatusEnum,
                        )
                    }
                >
                    <SelectTrigger className="w-50">
                        <SelectValue placeholder="Selecione" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="clear">Limpar</SelectItem>
                        <SelectItem value={MonitoringStatusEnum.ACTIVE}>
                            Ativo
                        </SelectItem>
                        <SelectItem value={MonitoringStatusEnum.PAUSED}>
                            Pausado
                        </SelectItem>
                    </SelectContent>
                </Select>
            </div>

            <Button type="submit">Filtrar</Button>
        </form>
    );
};
