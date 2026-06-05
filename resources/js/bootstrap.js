import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Load Confetti library for animations
import confetti from 'canvas-confetti';
window.confetti = confetti;
