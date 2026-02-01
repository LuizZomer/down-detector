import { router } from "@inertiajs/react";
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

export const AvailabilityFilterList = () => {
    const [selectedStatus, setSelectedStatus] =
        useState<MonitoringStatusEnum | null>();

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
                        setSelectedStatus(value as MonitoringStatusEnum)
                    }
                >
                    <SelectTrigger className="w-50">
                        <SelectValue placeholder="Selecione" />
                    </SelectTrigger>
                    <SelectContent>
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
