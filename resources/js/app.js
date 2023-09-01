import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
//inertia SPA
import { Link } from '@inertiajs/vue3'

//components
import ExampleComponent from './components/ExampleComponent.vue';
// import * as myComponents from './teste';
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
      .component('Link', Link)
      .component('example-component', ExampleComponent)
    //   .component('example-component', myComponents.ExampleComponent)
    //   app.config.globalProperties.$route = route;
      app.mount(el)

  },
})
