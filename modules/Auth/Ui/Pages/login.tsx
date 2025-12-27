import { Field, FieldLabel } from "@/components/ui/field.js";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { useLoginForm, type TLoginForm } from "../Hooks/Form/use-login-form.js";

export default function Login() {
    const methods = useLoginForm();

    const onSubmit = (data: TLoginForm) => {
        console.log(data);
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
                    <Field>
                        <FieldLabel htmlFor="email">Email</FieldLabel>
                        <Input
                            type="email"
                            id="email"
                            placeholder=""
                            {...methods.register("email")}
                        />
                    </Field>
                    <Field>
                        <FieldLabel htmlFor="password">Senha</FieldLabel>
                        <Input
                            type="password"
                            id="password"
                            {...methods.register("password")}
                        />
                    </Field>
                    <Button>Login</Button>
                </form>
            </div>

            <div className="w-full h-screen">
                <img src="/banners/loginBanner.jpg" className="h-full w-full" />
            </div>
        </div>
    );
}
