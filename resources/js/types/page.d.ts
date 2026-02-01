import type { PageProps as InertiaPageProps } from "@inertiajs/core";

export interface FlashMessages {
    success?: string;
    error?: string;
    warning?: string;
    info?: string;
}

export interface PageProps extends InertiaPageProps {
    flash?: FlashMessages;
}
