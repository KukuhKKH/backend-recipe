require('./bootstrap')

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import methodsMixin from './methodsMixin'
import moment from 'moment'
moment.locale('id')

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Recipe App'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const appVue = createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })

        appVue.config.globalProperties.$filters = methodsMixin
        return appVue.mount(el)
    },
})

InertiaProgress.init({ color: '#4B5563' })
