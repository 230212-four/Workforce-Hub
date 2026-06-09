import './bootstrap'; 
import '../css/app.css'; 

import { createApp } from 'vue';
import router from './router';
import App from './App.vue';
import { hydrateAuth } from './composables/useAuth';

const app = createApp(App);

app.use(router);

hydrateAuth()
  .catch(() => {
    // Invalid persisted sessions are cleared by the auth composable.
  })
  .finally(() => {
    app.mount('#app');
  });
