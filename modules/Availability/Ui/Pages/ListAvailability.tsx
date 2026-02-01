import { type IAvailability } from "../types/Availability";
import { useState } from "react";
import { Button } from "@/components/ui/button";
import { TableList } from "../components/TableList";
import { EmptyAvailability } from "../components/EmptyAvailability";
import { CreateAvailabilityModal } from "../components/modals/CreateAvailabilityModal";
import { PlusCircle } from "lucide-react";
import { AvailabilityFilterList } from "../components/AvailabilityFilterList";

interface ListAvailabilityProps {
    availabilities: PaginatedResponse<IAvailability>;
}

export default function ListAvailability({
    availabilities,
}: ListAvailabilityProps) {
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
                <CreateAvailabilityModal
                    trigger={
                        <Button>
                            <PlusCircle />
                            Criar monitoramento
                        </Button>
                    }
                />
            </header>

            <AvailabilityFilterList />

            <section className="rounded-lg border bg-background p-4 shadow-sm">
                {availabilities.data.length === 0 ? (
                    <EmptyAvailability />
                ) : (
                    <TableList availabilities={availabilities.data} />
                )}
            </section>
        </main>
    );
}
