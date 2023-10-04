import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
//inertia SPA
import { Link } from '@inertiajs/vue3'
//pacotes terceiros
import Swal from 'sweetalert2'
import VueApexCharts from "vue3-apexcharts";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
//components
import * as components from './components';
createInertiaApp({
  progress: {
      delay: 250,
      // The color of the progress bar.
      color: '#ff0a0a',
      // Whether to include the default NProgress styles.
      includeCSS: true,
      // Whether the NProgress spinner will be shown.
      showSpinner: false,
  },
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(VueApexCharts)
      //layouts
      .component('layout-auth', components.AuthLayout)
      .component('layout-dashboard', components.DashboardLayout)
      //components
      .component('Link', Link)
      .component('simple-card', components.SimpleCard)
      .component('icon-card', components.IconCard)
      .component('button-load', components.ButtonLoad)
      .component('modal', components.Modal)
      .component('paginate', components.Paginate)
      .component('v-table', components.Vtable)
      .component('VueDatePicker', VueDatePicker);
      app.config.globalProperties.$alert = Swal;
      app.config.globalProperties.$route = route;
      app.mount(el)

  },
})
