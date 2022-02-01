require('./bootstrap');

import { createApp, h } from 'vue'
import { App, plugin } from '@inertiajs/inertia-vue3'
import VueSweetalert2 from 'vue-sweetalert2'

import 'sweetalert2/dist/sweetalert2.min.css'

const el = document.getElementById('app')

createApp({
    render: () => h(App, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => require(`./Pages/${name}`).default,
        title: title => title ? `${title} - Recipe Application` : 'Recipe Application'
    })
})
.mixin({
    methods: {
        route: window.route
    },
})
.use(plugin)
.use(VueSweetalert2)
.mount(el)
