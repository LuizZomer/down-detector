import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import z from "zod";

export const availabilitySchema = z.object({
    name: z
        .string()
        .trim()
        .min(3, "O nome deve ter no mínimo 3 caracteres")
        .max(100, "O nome pode ter no máximo 100 caracteres"),

    url: z
        .url("Informe uma URL válida (ex: https://exemplo.com)")
        .max(150, "A URL pode ter no máximo 150 caracteres"),

    frequency: z
        .string()
        .min(1, "A frequência é obrigatória")
        .refine(
            (value) => {
                const number = Number(value);
                return Number.isInteger(number);
            },
            {
                message: "A frequência deve ser um número inteiro",
            },
        )
        .refine(
            (value) => {
                const number = Number(value);
                return number >= 10 && number <= 86400;
            },
            {
                message:
                    "A frequência deve estar entre 10 e 86400 segundos (24h)",
            },
        ),

    sendEmail: z.enum(["true", "false"], {
        message: "Informe se deseja receber notificações por e-mail",
    }),
});

export type TAvailabilitySchema = z.infer<typeof availabilitySchema>;

export const useAvailabilityForm = () => {
    const methods = useForm<TAvailabilitySchema>({
        resolver: zodResolver(availabilitySchema),
        defaultValues: {
            frequency: "",
            name: "",
            sendEmail: "false",
            url: "",
        },
    });

    return methods;
};
