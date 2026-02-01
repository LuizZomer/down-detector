export function createClearableSelectHandler<T>(
    setState: React.Dispatch<React.SetStateAction<T | null>>,
    clearValue: string = "clear",
    value: T,
) {
    if (value === clearValue) {
        setState(null);
    } else {
        setState(value as T);
    }
}
