import { createApp, DefineComponent, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { Link as InertiaLink } from "@inertiajs/inertia-vue3";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { plugin as VueTippy } from "vue-tippy";
import "../css/app.css";
import "./fontawesome";

const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue');
const resolvePageComponent = (name: string ): Promise<DefineComponent> => {
    for (const path in pages) {
        if (path.endsWith(`${name}.vue`)) {
            return pages[path]();
        }
    }

    throw new Error(`Page was not found: ${name}`);
};

createInertiaApp({
    resolve: resolvePageComponent,

    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(VueTippy)
            .component('inertia-link', InertiaLink)
            .component('fontawesome-icon', FontAwesomeIcon)
            .mount(el);
    },
}).catch(console.error);
