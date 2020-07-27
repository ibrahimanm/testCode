require('./bootstrap')

window.Vue = require('vue');

require('./auth/login')
require('./auth/password-reset')

const app = new Vue({
    el: '#app'
});
