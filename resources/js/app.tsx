import "../css/app.css";
import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createRoot } from "react-dom/client";
import AppLayout from "./components/layouts/AppLayout";
import type { InertiaPage } from "./types/inertia";

createInertiaApp({
    resolve: async (name: string) => {
        let page: { default: InertiaPage };

        if (name.includes("::")) {
            const [module, pageName] = name.split("::");

            const modulePages = import.meta.glob(
                "../../modules/**/Ui/Pages/**/*.tsx",
            );

            page = (await resolvePageComponent(
                `../../modules/${module}/Ui/Pages/${pageName}.tsx`,
                modulePages,
            )) as { default: InertiaPage };
        } else {
            const pages = import.meta.glob("./Ui/Pages/**/*.tsx");

            page = (await resolvePageComponent(
                `./Ui/Pages/${name}.tsx`,
                pages,
            )) as { default: InertiaPage };
        }

        page.default.layout ??= (pageEl) => <AppLayout>{pageEl}</AppLayout>;

        return page;
    },

    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});
