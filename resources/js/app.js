import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import { ZiggyVue } from 'ziggy'

// NProgress.configure({
//   minimum: 0.1,
//   easing: 'ease',
//   speed: 500,
//   showSpinner: false,
//   trickle: false
// })

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page =  pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || MainLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
    .use(plugin)
    .use(ZiggyVue)
    .mount(el)
  },
  // progress: false,
  progress: {
    // Show progress bar after this delay (ms) - prevents flashing for fast page transitions
    delay: 250,
    
    // Progress bar color (can be any CSS color value)
    color: '#432dd7',
    
    // Whether to show the spinner
    showSpinner: false,
    
    // Animation easing (CSS easing function)
    easing: 'ease',
    
    // Animation speed (ms)
    speed: 200,
    
    // Whether to include the default NProgress styles
    includeCSS: true,
    
    // Class name added to the progress bar element
    className: 'inertia-progress',
    
    // Minimum percentage used upon starting
    // minimum: 0.08,
    
    // Adjust animation settings
    trickle: true,
    trickleSpeed: 200,
    
    // Parent element where progress bar will be appended
    parent: 'body',
    
    // Template HTML string
    template: `
      <div class="bar" role="bar">
        <div class="peg"></div>
      </div>
      <div class="spinner" role="spinner">
        <div class="spinner-icon"></div>
      </div>
    `
  }
})