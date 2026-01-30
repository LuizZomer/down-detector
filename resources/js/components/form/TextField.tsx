import { Input } from "../ui/input";
import { FieldWrapper } from "./base/FieldWrapper";

interface TextFieldProps {
    name: string;
    label: string;
    error?: string | undefined;
    inputProps?: React.ComponentProps<typeof Input>;
    description?: string;
}

export function TextField({
    name,
    label,
    error,
    inputProps,
    description,
}: TextFieldProps) {
    return (
        <FieldWrapper
            label={label}
            htmlFor={name}
            error={error}
            description={description}
        >
            <Input id={name} aria-invalid={!!error} {...inputProps} />
        </FieldWrapper>
    );
}
