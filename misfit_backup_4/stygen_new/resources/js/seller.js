require('./bootstrap');

window.Vue = require('vue').default;

//Vue Router--------------
import VueRouter from 'vue-router'
Vue.use(VueRouter)
//Vue Router--------------

//Vue Component----------
Vue.component('seller-master', require('./components/seller/SellerMaster').default);

//Router Support---------
import router from './seller/router'

//Support Store----------
import {store} from "./common/store/store";

//Support Element UI-----
import library from './common/library'

//Editor
import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

const backend = new Vue({
    el: '#seller',
    router,
    store,
});
