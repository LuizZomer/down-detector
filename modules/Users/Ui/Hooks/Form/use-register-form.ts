import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import z from "zod";

const schema = z
    .object({
        name: z
            .string()
            .min(1, "O nome é obrigatório")
            .max(100, "O nome deve ter no máximo 100 caracteres"),
        email: z.email("Email inválido"),
        password: z.string().min(6, "A senha deve ter no mínimo 6 caracteres"),
        confirmPassword: z.string(),
    })
    .refine((data) => data.password === data.confirmPassword, {
        message: "As senhas não coincidem",
        path: ["confirmPassword"],
    });

export type TRegisterForm = z.infer<typeof schema>;

export const useRegisterForm = () => {
    const methods = useForm<TRegisterForm>({
        resolver: zodResolver(schema),
        defaultValues: {
            email: "",
            name: "",
            password: "",
            confirmPassword: "",
        },
    });

    return methods;
};
