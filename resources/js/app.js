import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
//inertia SPA
import { Link } from '@inertiajs/vue3'
//pacotes terceiros
import Swal from 'sweetalert2'
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
      //layouts
      .component('layout-auth', components.AuthLayout)
      //components
      .component('Link', Link)
      .component('simple-card', components.SimpleCard)
      .component('modal', components.Modal)
      app.config.globalProperties.$alert = Swal;
    //   app.config.globalProperties.$route = route;
      app.mount(el)

  },
})
