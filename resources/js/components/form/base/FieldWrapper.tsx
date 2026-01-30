import { Field, FieldError, FieldLabel } from "../../ui/field";

interface FieldWrapperProps {
    label: string;
    htmlFor: string;
    error?: string | undefined;
    children: React.ReactNode;
    description: string | undefined;
}

export function FieldWrapper({
    label,
    htmlFor,
    error,
    children,
    description,
}: FieldWrapperProps) {
    return (
        <Field data-invalid={!!error}>
            <FieldLabel htmlFor={htmlFor}>{label}</FieldLabel>

            {children}

            {!error && description && (
                <p className="text-sm text-gray-600">{description}</p>
            )}

            {error && <FieldError>{error}</FieldError>}
        </Field>
    );
}
