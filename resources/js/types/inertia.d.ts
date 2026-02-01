import type { ComponentType, ReactNode } from "react";

export type InertiaPage = ComponentType & {
    layout?: (page: ReactNode) => ReactNode;
};
