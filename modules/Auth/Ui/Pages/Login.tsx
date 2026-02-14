import { Link, router } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { useLoginForm, type TLoginForm } from "../Hooks/Form/use-login-form.js";
import { TextField } from "@/components/form/TextField.js";
import { toast } from "sonner";

export default function Login() {
    const methods = useLoginForm();
    const errors = methods.formState.errors;

    const onSubmit = (data: TLoginForm) => {
        router.post("/auth", data, {
            onError: (errors) => {
                toast.error(errors.email);
            },
            preserveScroll: true,
        });
    };

    return (
        <div className="flex min-h-screen bg-background text-foreground">
            <div className="w-1/2 flex justify-center items-center flex-col ">
                <div className="text-center mb-8">
                    <h1 className="text-4xl font-bold tracking-tight">
                        Down<span className="text-primary">Detector</span>
                    </h1>

                    <p className="mt-2 text-sm text-muted-foreground">
                        Faça login para continuar
                    </p>
                </div>
                <form
                    className="flex flex-col gap-4 max-w-2xs w-full"
                    onSubmit={methods.handleSubmit(onSubmit)}
                >
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
                    <Button>Login</Button>
                </form>
                <div className="mt-4">
                    <Link href="/users" className="underline">
                        Não tem conta?
                    </Link>
                </div>
            </div>

            <div className="w-full h-screen">
                <img src="/banners/loginBanner.jpg" className="h-full w-full" />
            </div>
        </div>
    );
}
