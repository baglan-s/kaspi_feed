import { createApp } from 'vue'

import App from 'Components/App.vue';
import { createRouter, createWebHistory } from 'vue-router'
import routes from 'Routes/index.js';
import store from 'Store/main.js'
import middleware from "@grafikri/vue-middleware"
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import PrimeVueComponentHelper from 'Helpers/PrimeVueComponentHelper.js';

// styles import
import 'primevue/resources/themes/bootstrap4-light-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../scss/style.scss';
import '../icons/favicon.ico';

const router = createRouter({
    history: createWebHistory(),
    routes,
})
router.beforeEach(middleware({ store }))

const app = createApp(App)

app.use(router)
app.use(store)
app.use(PrimeVue)
app.use(ToastService)

PrimeVueComponentHelper({ app })

app.mount('#app');