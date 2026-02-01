import { Button } from "@/components/ui/button";
import {
    Popover,
    PopoverContent,
    PopoverDescription,
    PopoverHeader,
    PopoverTitle,
    PopoverTrigger,
} from "@/components/ui/popover";
import { Trash } from "lucide-react";

export const DeleteAvailabilityPopover = ({ title }: { title: string }) => {
    const handleDelete = () => {
        console.log("Apagado");
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
