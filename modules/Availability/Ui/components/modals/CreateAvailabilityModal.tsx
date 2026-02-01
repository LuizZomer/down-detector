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
import { CheckboxField } from "@/components/form/CheckboxField";
import { router } from "@inertiajs/react";
import { Controller } from "react-hook-form";
import { route } from "ziggy-js";
import { useState } from "react";

export const CreateAvailabilityModal = ({
    trigger,
}: {
    trigger: React.ReactNode;
}) => {
    const [open, setOpen] = useState(false);
    const [isSubmitting, setIsSubmitting] = useState(false);
    const {
        handleSubmit,
        register,
        control,
        reset,
        formState: { errors },
    } = useAvailabilityForm();

    const onSubmit = (data: TAvailabilitySchema) => {
        const payload = {
            ...data,
            frequency: Number(data.frequency),
            sendEmail: data.sendEmail === "true",
        };

        setIsSubmitting(true);

        router.post(route("availability.store"), payload, {
            onSuccess: () => {
                reset();
                setOpen(false);
            },
            onFinish: () => {
                setIsSubmitting(false);
            },
        });
    };

    const handleOpenChange = (isOpen: boolean) => {
        if (!isOpen) {
            reset();
        }
        setOpen(isOpen);
    };

    return (
        <Dialog open={open} onOpenChange={handleOpenChange}>
            <DialogTrigger asChild>{trigger}</DialogTrigger>

            <DialogContent className="sm:max-w-106.25">
                <form onSubmit={handleSubmit(onSubmit)}>
                    <DialogHeader>
                        <DialogTitle>Criar um novo monitoramento</DialogTitle>
                        <DialogDescription>
                            Configure como o site será monitorado e como você
                            deseja receber alertas.
                        </DialogDescription>
                    </DialogHeader>

                    <div className="grid gap-4">
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
                                        type: "number",
                                        placeholder: "Ex: 2",
                                        ...register("frequency"),
                                    }}
                                    description="Informe o intervalo em segundos (ex: 30 = 30s, 60 = 1 minuto)"
                                />
                            </div>
                            <div className="grid gap-3">
                                <Controller
                                    name="sendEmail"
                                    control={control}
                                    render={({ field }) => (
                                        <CheckboxField
                                            name="sendEmail"
                                            label="Me avisar por email quando o site ficar indisponível"
                                            error={errors.sendEmail?.message}
                                            inputProps={{
                                                checked:
                                                    String(field.value) ===
                                                    "true",
                                                onCheckedChange: (checked) => {
                                                    field.onChange(
                                                        checked
                                                            ? "true"
                                                            : "false",
                                                    );
                                                },
                                            }}
                                        />
                                    )}
                                />
                            </div>
                        </div>
                    </div>

                    <DialogFooter>
                        <DialogClose asChild>
                            <Button type="button" variant="outline">
                                Cancelar
                            </Button>
                        </DialogClose>
                        <Button type="submit" disabled={isSubmitting}>
                            {isSubmitting ? "Salvando..." : "Salvar"}
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    );
};
