//Support Element UI-----
import Vue from 'vue'

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI, { locale })

//Filter Support
import filter from './filter'

//Support Number Format
import numeral from 'numeral';
import numFormat from 'vue-filter-number-format';

Vue.filter('numFormat', numFormat(numeral));

Vue.filter('sortlength',(text, length, suffix)=> {
    return text.substring(0, length) + suffix;
})
