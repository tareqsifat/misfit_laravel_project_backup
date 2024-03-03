import Vue from 'vue'

import moment from 'moment'

Vue.filter('timeFormat', (arg) => {
   return moment(arg).format('Do MMMM YYYY');
});

Vue.filter('orderTimeFormat', (arg) => {
    return moment(arg).format('LLL');
 });
