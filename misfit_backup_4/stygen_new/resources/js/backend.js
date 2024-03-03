require('./bootstrap');

window.Vue = require('vue').default;

//Vue Router--------------
import VueRouter from 'vue-router'
Vue.use(VueRouter)
//Vue Router--------------

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)

//Vue Component----------
Vue.component('backend-master', require('./components/backend/BackendMaster').default);

//Router Support---------
import router from './backend/router'

//Support Store----------
import {store} from "./common/store/store";

//Support Element UI-----
import library from './common/library'

//Editor
import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

const backend = new Vue({
    el: '#backend',
    router,
    store,
});
