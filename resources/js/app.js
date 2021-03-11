import Vue from 'vue'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import { App, plugin } from '@inertiajs/inertia-vue'
import VueMeta from "vue-meta";
Vue.use(plugin)
Vue.use(Vuetify)
Vue.use(VueMeta)

const el = document.getElementById('app')

new Vue({
    vuetify: new Vuetify({
        theme: {
            options: {
                customProperties: true,
            },
            themes: {
                light: {
                    primary: {
                        base: "#A60402",
                        darken1: "#590209",
                        lighten1: "#D91828",
                    },
                    error: "#CC0000",
                    info: "#0099CC",
                    success: "#007E33",
                    warning: "#FF8800",
                },
            },
        },
    }),

    metaInfo: {
        titleTemplate: title => (title ? `${title} - SeeTV` : 'SeeTV'),
    },

    render: h =>
        h(App, {
            props: {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
            },
        }),
}).$mount(el)
