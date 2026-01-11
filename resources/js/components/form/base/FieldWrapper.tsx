import { Field, FieldError, FieldLabel } from "../../ui/field";

interface FieldWrapperProps {
    label: string;
    htmlFor: string;
    error?: string | undefined;
    children: React.ReactNode;
}

export function FieldWrapper({
    label,
    htmlFor,
    error,
    children,
}: FieldWrapperProps) {
    return (
        <Field data-invalid={!!error}>
            <FieldLabel htmlFor={htmlFor}>{label}</FieldLabel>

            {children}

            {error && <FieldError>{error}</FieldError>}
        </Field>
    );
}
