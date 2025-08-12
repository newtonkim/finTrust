import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import VueApexCharts from 'vue3-apexcharts';
import { registerPlugins } from '@core/utils/plugins'

// Styles needed for Vuetify and layout
import '@core-scss/template/index.scss'
import '@layouts/styles/index.scss'
import '@styles/styles.scss'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob('./pages/**/*.vue')
        return resolvePageComponent(`./pages/${name}.vue`, pages).then((module) => {
            const layouts = import.meta.glob('./layouts/**/*.vue')
            const comp = module?.default || {}

            // If the page declares a string layout name (e.g., 'default' or 'blank'), load and attach it
            if (typeof comp.layout === 'string') {
                const direct = `./layouts/${comp.layout}.vue`
                const index = `./layouts/${comp.layout}/index.vue`
                const loader = layouts[direct] || layouts[index]
                if (loader) {
                    return loader().then(lm => {
                        module.default.layout = lm.default
                        return module
                    })
                }
            }

            // Fallback: if no layout specified, use 'default' layout when available
            if (!comp.layout && layouts['./layouts/default.vue']) {
                return layouts['./layouts/default.vue']().then(lm => {
                    module.default.layout = lm.default
                    return module
                })
            }

            return module
        })
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })

        // Inertia plugin
        app.use(plugin)

        // Third-party plugins
        app.use(VueApexCharts)

        // Register project plugins (Vuetify, Pinia, icons, etc.)
        registerPlugins(app)

        // Mount app
        app.mount(el)

        return app
    },
    progress: {
        color: '#4B5563',
    },
});
