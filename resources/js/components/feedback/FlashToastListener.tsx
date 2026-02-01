import type { PageProps } from "@/types/page";
import { usePage } from "@inertiajs/react";
import { useEffect } from "react";
import { toast } from "sonner";

export function FlashToastListener() {
    const { flash } = usePage<PageProps>().props;

    useEffect(() => {
        console.log(flash);
        if (flash?.success) {
            toast.success(flash.success);
        }

        if (flash?.error) {
            toast.error(flash.error);
        }
    }, [flash]);

    return null;
}
