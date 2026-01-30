import { TextField } from "@/components/form/TextField";
import { Button } from "@/components/ui/button";
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { PlusCircle } from "lucide-react";
import {
    useAvailabilityForm,
    type TAvailabilitySchema,
} from "../../hooks/form/useAvailabilityForm";

export const CreateAvailabilityModal = () => {
    const {
        handleSubmit,
        register,
        formState: { errors },
    } = useAvailabilityForm();

    const onSubmit = (data: TAvailabilitySchema) => {
        console.log(data);
    };

    return (
        <Dialog>
            <form onSubmit={handleSubmit(onSubmit)}>
                <DialogTrigger asChild>
                    <Button>
                        Criar monitoramento <PlusCircle />
                    </Button>
                </DialogTrigger>
                <DialogContent className="sm:max-w-106.25">
                    <DialogHeader>
                        <DialogTitle>Criar um novo monitoramento</DialogTitle>
                    </DialogHeader>
                    <div className="grid gap-4">
                        <div className="grid gap-3">
                            <TextField
                                label="Nome"
                                name="name"
                                error={errors.name?.message}
                                inputProps={{
                                    placeholder: "Ex: Site Exemplo",
                                    ...register("name"),
                                }}
                            />
                        </div>
                        <div className="grid gap-3">
                            <TextField
                                label="Url"
                                name="url"
                                error={errors.url?.message}
                                inputProps={{
                                    placeholder: "Ex: site@exemplo.com",
                                    ...register("url"),
                                }}
                            />
                        </div>
                        <div className="grid gap-3">
                            <TextField
                                label="Frequência"
                                name="frequency"
                                error={errors.frequency?.message}
                                inputProps={{
                                    placeholder: "Ex: 2",
                                    ...register("frequency"),
                                }}
                                description="Informe o intervalo em segundos (ex: 30 = 30s, 60 = 1 minuto)"
                            />
                        </div>
                    </div>
                    <DialogFooter>
                        <DialogClose asChild>
                            <Button variant="outline">Cancelar</Button>
                        </DialogClose>
                        <Button type="submit">Salvar</Button>
                    </DialogFooter>
                </DialogContent>
            </form>
        </Dialog>
    );
};
