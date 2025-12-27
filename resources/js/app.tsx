import "../css/app.css";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createRoot } from "react-dom/client";

createInertiaApp({
    resolve: (name: string) => {
        if (name.includes("::")) {
            const [module, page] = name.split("::");

            const modulePages = import.meta.glob(
                "../../modules/**/Ui/Pages/**/*.tsx"
            );

            const path = `../../modules/${module}/Ui/Pages/${page}.tsx`;

            return resolvePageComponent(path, modulePages);
        }

        const pages = import.meta.glob("./Ui/Pages/**/*.tsx");
        return resolvePageComponent(`./Ui/Pages/${name}.tsx`, pages);
    },
    setup({ el, App, props }: { el: HTMLElement; App: any; props: any }) {
        createRoot(el).render(<App {...props} />);
    },
});
