import { Button } from "@/components/ui/button";
import {
    Popover,
    PopoverContent,
    PopoverDescription,
    PopoverHeader,
    PopoverTitle,
    PopoverTrigger,
} from "@/components/ui/popover";
import { router, usePage } from "@inertiajs/react";
import { Trash } from "lucide-react";
import { toast } from "sonner";
import { route } from "ziggy-js";

export const DeleteAvailabilityPopover = ({
    title,
    id,
}: {
    title: string;
    id: number;
}) => {
    const handleDelete = () => {
        router.delete(route("availability.delete", id));
    };

    return (
        <Popover>
            <PopoverTrigger asChild>
                <Button size="icon" variant="destructive">
                    <Trash />
                </Button>
            </PopoverTrigger>
            <PopoverContent>
                <PopoverHeader>
                    <PopoverTitle>
                        Deseja deletar o monitoramento {title}?
                    </PopoverTitle>
                    <PopoverDescription>
                        <div className="flex flex-col gap-2">
                            <p>O monitoramento será removido permanentemente</p>
                            <Button onClick={handleDelete}>Confirmar</Button>
                        </div>
                    </PopoverDescription>
                </PopoverHeader>
            </PopoverContent>
        </Popover>
    );
};
