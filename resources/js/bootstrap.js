window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Apex Charts
 */
import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

/**
 * Loadind Filepond
 */
require('./filepond');

/**
 * Biblioteca de escolha de datas
 */
require('./pikaday');

/**
 * Máscara de moeda
 */
import IMask from 'imask';
window.IMask = IMask;

/**
 * Mapas
 */
import MapLots from 'maplots/src/maplots';
window.MapLots = MapLots;

/**
 * Jquery
 */
window.$ = window.jQuery = require('jquery');

/**
 * Select 2
 */
require('select2/dist/js/select2');
require('select2/dist/js/i18n/pt-BR');

/**
 * Loading Alpine JS - TALL Stack
 */
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
