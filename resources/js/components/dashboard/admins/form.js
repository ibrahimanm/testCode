import {Switch} from 'element-ui'
Vue.component('admins-form', {

    props: {
        user: Object,

    },

    data() {
        return {
            name: null,
            mobile: null,
            email: null,
            password: null,
            active: true,

            avatarLoading: false,
        }
    },

    mounted() {
        if(this.user) {
            this.name = this.user.name;
            this.mobile = this.user.mobile;
            this.email = this.user.email;
            this.active = !!this.user.active;
        }

    },

    methods: {
        save() {
            let url = this.user ? `/dashboard/admins/${this.user.id}` : '/dashboard/admins';
            let method = this.user ? 'PUT' : 'POST';

            this.saveForm(url, method, '/dashboard/admins', {
                name: this.name,
                mobile: this.mobile,
                email: this.email,
                password: this.password,
                active: this.active,
            });
        },

    },

    computed: {

    },

    components: {
        [Switch.name] : Switch,
    }
});
