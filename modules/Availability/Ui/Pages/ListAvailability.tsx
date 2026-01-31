import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import {
    MonitoringStatusEnum,
    type IAvailability,
} from "../types/Availability";
import { router } from "@inertiajs/react";
import { useState } from "react";
import { route } from "ziggy-js";
import { Button } from "@/components/ui/button";
import { TableList } from "../components/TableList";
import { EmptyAvailability } from "../components/EmptyAvailability";
import { PlusCircle } from "lucide-react";
import { CreateAvailabilityModal } from "../components/modals/CreateAvailabilityModal";

interface ListAvailabilityProps {
    availabilities: IAvailability[];
}

export default function ListAvailability({
    availabilities,
}: ListAvailabilityProps) {
    const [selectedStatus, setSelectedStatus] =
        useState<MonitoringStatusEnum | null>();

    const handleSubmitFilter = (e: React.FormEvent) => {
        e.preventDefault();

        router.get(route("availability.index"), {
            status: selectedStatus,
        });
    };

    return (
        <main className="p-6 space-y-6">
            <header className="flex justify-between items-center space-y-1 w-full">
                <div>
                    <h1 className="text-2xl font-semibold tracking-tight">
                        Lista de monitoramento
                    </h1>
                    <p className="text-sm text-muted-foreground">
                        Acompanhe o status dos sites monitorados
                    </p>
                </div>
                <CreateAvailabilityModal />
            </header>

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

            {/* Table */}
            <section className="rounded-lg border bg-background p-4 shadow-sm">
                {availabilities.length === 0 ? (
                    <EmptyAvailability />
                ) : (
                    <TableList availabilities={availabilities} />
                )}
            </section>
        </main>
    );
}
