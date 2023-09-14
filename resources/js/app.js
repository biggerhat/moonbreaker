import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import PrimeVue from 'primevue/config';
import ConfirmationService from 'primevue/confirmationservice';
import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css'
import 'primevue/resources/themes/arya-blue/theme.css';

import AppLayout from '@/Layouts/AppLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Cinderborn';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        // resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
        const pages = import.meta.glob("./Pages/**/*.vue");
        const imported = pages[`./Pages/${name}.vue`];
        const page = (await (typeof imported === "function" ? imported() : imported)).default

        page.layout ??= AppLayout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, { ripple: true })
            .use(ConfirmationService)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
