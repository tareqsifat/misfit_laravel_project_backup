require('./bootstrap');

window.Vue = require('vue').default;
Vue.config.productionTip = false;

//Vue Router--------------
import VueRouter from 'vue-router'
Vue.use(VueRouter)
//Vue Router--------------

// Support Meta
// import VueMeta from 'vue-meta'
// Vue.use(VueMeta)

//Vue Component----------
Vue.component('frontend-master', require('./components/frontend/FrontendMaster').default);
// Vue.component('meta-test', require('./components/frontend/MetaTest'));

//Router Support---------
import router from './frontend/router'

//Support Store----------
import {store} from "./common/store/store";

//Support Element UI-----
import library from './common/library'

//Support Image Enlarge
import ImageMagnifier from 'vue-image-magnifier'
Vue.use(ImageMagnifier)


// Vue.use(VueMeta)

const frontend = new Vue({
    el: '#frontend',
    router,
    store,
});
