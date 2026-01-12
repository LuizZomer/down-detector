import { Link, router } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { TextField } from "@/components/form/TextField.js";
import { toast } from "sonner";
import {
    useRegisterForm,
    type TRegisterForm,
} from "../Hooks/Form/use-register-form";

export default function Register() {
    const methods = useRegisterForm();
    const errors = methods.formState.errors;

    const onSubmit = (data: TRegisterForm) => {
        router.post("/auth", data, {
            onError: (errors) => {
                toast.error(errors.email);
            },
            preserveScroll: true,
        });
    };

    return (
        <div className="flex min-h-screen bg-background text-foreground">
            <div className="w-full h-screen">
                <img src="/banners/loginBanner.jpg" className="h-full w-full" />
            </div>

            <div className="w-1/2 flex justify-center items-center flex-col ">
                <div className="text-center mb-8">
                    <h1 className="text-4xl font-bold tracking-tight">
                        Down<span className="text-primary">Detector</span>
                    </h1>

                    <p className="mt-2 text-sm text-muted-foreground">
                        Crie sua conta para continuar
                    </p>
                </div>
                <form
                    className="flex flex-col gap-4 max-w-2xs w-full"
                    onSubmit={methods.handleSubmit(onSubmit)}
                >
                    <TextField
                        label="Nome"
                        name="nome"
                        error={errors.name?.message}
                        inputProps={{
                            type: "text",
                            placeholder: "Insira seu nome",
                            ...methods.register("name"),
                        }}
                    />
                    <TextField
                        label="Email"
                        name="email"
                        error={errors.email?.message}
                        inputProps={{
                            type: "email",
                            placeholder: "Ex: exemplo@exemplo.com",
                            ...methods.register("email"),
                        }}
                    />
                    <TextField
                        label="Senha"
                        name="password"
                        error={errors.password?.message}
                        inputProps={{
                            type: "password",
                            placeholder: "Insira sua senha",
                            ...methods.register("password"),
                        }}
                    />
                    <TextField
                        label="Confirme sua senha"
                        name="confirmPassword"
                        error={errors.confirmPassword?.message}
                        inputProps={{
                            type: "password",
                            placeholder: "Confirme sua senha",
                            ...methods.register("confirmPassword"),
                        }}
                    />
                    <Button>Login</Button>
                </form>
                <div className="mt-4">
                    <Link href="/auth" className="underline">
                        Já tem conta?
                    </Link>
                </div>
            </div>
        </div>
    );
}
