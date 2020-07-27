import {Switch} from 'element-ui'
import {Select} from 'element-ui'
import {Radio} from 'element-ui'
import {Upload} from 'element-ui'
Vue.component('payment-form', {

    props: {
       // user: Object,

    },

    data() {
        return {
            type: null,
            value: 0,
            user_type: 'delegate',
            delegate: null,
            driver: null,
            options:[
                {
                    value: 'from_admin',
                    name: 'دفعة للمندوب'
                }, {
                    value: 'to_admin',
                    name: 'دفعة من المندوب'
                }
            ],
            avatarLoading: false,
            drivers_list : [],
            delegates_list : [],
            payment_method : 'cash',
            image : null,

        }
    },

    mounted() {
        // if(this.user) {
        //     this.name = this.user.name;
        //     this.mobile = this.user.mobile;
        //     this.email = this.user.email;
        //     this.active = !!this.user.active;
        // }

    },

    methods: {
        save() {
            let url = '/dashboard/payments';
            let method = this.user ? 'PUT' : 'POST';

            this.saveForm(url, method, '/dashboard/payments', {
                type: this.type,
                value: this.value,
                user_type: this.user_type,
                delegate: this.delegate,
                driver: this.driver,
                payment_method: this.payment_method,
                image: this.image,
            });
        },

        getDrivers(query) {
            if (query !== '') {

            axios.get('/dashboard/payments/searchDrivers?search='+query).then(response => {
                this.drivers_list=response.data;

            });
            } else {
                this.drivers_list = [];
            }
        },
        getDelegates(query) {
            console.log(query)
            if (query !== '') {
                axios.get('/dashboard/payments/searchDelegates?search='+query).then(response => {
                    this.delegates_list=response.data;

                });
            } else {
                this.delegates_list = [];
            }
        },

        handleAvatarSuccess(res, file) {
            this.avatarLoading = false;
            this.image = res.path;
        },
    },
    computed: {

    },

    components: {
        [Switch.name] : Switch,
        Select : 'el-select',
        Radio: 'el-radio',
        Upload,
    }
});
