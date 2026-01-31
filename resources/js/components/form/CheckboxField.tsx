import { Checkbox } from "../ui/checkbox";
import { FieldWrapper } from "./base/FieldWrapper";

interface CheckboxFieldProps {
    name: string;
    label: string;
    error?: string | undefined;
    inputProps?: React.ComponentProps<typeof Checkbox>;
    description?: string;
}

export function CheckboxField({
    name,
    label,
    error,
    inputProps,
    description,
}: CheckboxFieldProps) {
    return (
        <FieldWrapper
            label={label}
            htmlFor={name}
            error={error}
            description={description}
        >
            <div>
                <Checkbox id={name} aria-invalid={!!error} {...inputProps} />
            </div>
        </FieldWrapper>
    );
}
