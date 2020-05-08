/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
require('admin-lte');
require('overlayscrollbars');

/**
 * Datatables
 */
require('jszip');
require('pdfmake');
window.dt = require('datatables.net-bs4');

require('datatables.net-buttons-bs4')();
require('datatables.net-responsive-bs4');
require('datatables.net-buttons/js/buttons.colVis.js')();
require('datatables.net-buttons/js/buttons.flash.js')();
require('datatables.net-buttons/js/buttons.html5.js')();
require('datatables.net-buttons/js/buttons.print.js')();

/**
 * SweetAlert JS
 */
require('sweetalert');

/**
 * Numeral JS
 */
window.numeral = require('numeral');


/**
 * Element UI
 */
window.ElementUI = require('element-ui');
window.ElementUI_Lang = require('element-ui/lib/locale/lang/en');
Vue.use(ElementUI, {ElementUI_Lang});

/**
 * BootstrapVue
 */

window.BootstrapVue = require('bootstrap-vue');
Vue.use(BootstrapVue);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


//Modules Vue's
const files = require.context('../../Modules/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/


swal.setDefaults({
    closeOnClickOutside: false
});

import {Loading} from 'element-ui';

let loadingInstance = null;
var numberOfAjaxCAllPending = 0;
let token = null;
// Add a request interceptor
axios.interceptors.request.use(function (config) {

    numberOfAjaxCAllPending++;
    // show loader
    loadingInstance = Loading.service({
        fullscreen: true,
        lock: true,
        text: 'Loading',
        spinner: 'el-icon-loading'
    });
    return config;
}, function (error) {
    loadingInstance.close();
    return Promise.reject(error);
});

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    numberOfAjaxCAllPending--;
    if (numberOfAjaxCAllPending == 0) {
        //hide loader
        loadingInstance.close();
    }
    return response;
}, function (error) {
    loadingInstance.close();
    return Promise.reject(error);
});