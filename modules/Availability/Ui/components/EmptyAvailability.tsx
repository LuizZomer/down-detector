import { Globe, PlusCircle } from "lucide-react";
import { Button } from "@/components/ui/button";
import { CreateAvailabilityModal } from "./modals/CreateAvailabilityModal";

export const EmptyAvailability = () => (
    <div className="flex flex-col items-center justify-center rounded-lg border border-dashed p-10 text-center">
        <Globe className="h-10 w-10 text-muted-foreground mb-4" />

        <h3 className="text-lg font-semibold">Nenhum site monitorado</h3>

        <p className="text-sm text-muted-foreground mt-1 max-w-sm">
            Você ainda não cadastrou nenhum site para monitoramento. Comece
            adicionando o primeiro e acompanhe a disponibilidade em tempo real.
        </p>

        <CreateAvailabilityModal
            trigger={
                <Button className="mt-6" variant="default">
                    <PlusCircle className="mr-2 h-4 w-4" />
                    Adicionar site
                </Button>
            }
        />
    </div>
);
