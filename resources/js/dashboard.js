
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/ar'

import VueHighcharts from 'vue-highcharts';

Vue.use(VueHighcharts);

Vue.use(ElementUI, { locale })

window.__ = (key, replace) => {
    var translation = Booking.translations[key] ? Booking.translations[key] : key;

    _.forEach(replace, (value, key) => {
        translation = translation.replace(':'+key, value);
    });

    return translation;
};
window.moment = require('moment');


import TableComponent from 'vue-table-component';

Vue.use(TableComponent, {
    tableClass: 'table table-striped m-table',
    filterNoResults: 'لا يوجد بيانات للعرض',
    filterInputClass: 'form-control',
    filterPlaceholder: 'بحث',
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

require('./components/dashboard/admins/index');
require('./components/dashboard/admins/form');

require('./components/dashboard/drivers/index');
require('./components/dashboard/drivers/show');


require('./components/dashboard/delegates/index');
require('./components/dashboard/delegates/show');

require('./components/dashboard/clients/index');
require('./components/dashboard/clients/show');

require('./components/dashboard/confirmation_requests/index');
require('./components/dashboard/confirmation_requests/show');

require('./components/dashboard/delivery_orders/index');
require('./components/dashboard/delivery_orders/show');

require('./components/dashboard/taxi_orders/index');
require('./components/dashboard/taxi_orders/show');

require('./components/dashboard/complaints/index');
require('./components/dashboard/complaints/show');

require('./components/dashboard/settings/index');

require('./components/dashboard/notifications/index');

require('./components/dashboard/payments/index');
require('./components/dashboard/payments/form');


require('./components/dashboard/statistics/index');






import myMixin from './mixins'

Vue.mixin(myMixin);

const app = new Vue({
    el: '#app',
    data() {
        return {
            loading: false,
        }
    }
});
