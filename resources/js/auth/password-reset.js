Vue.component('password-reset', {
    data() {
        return {
            email: null,

            form: {
                disabled: false,
                error: false,
                validations: [],
                message: null,
            },
        }
    },

    methods: {
        reset() {
            this.form.disabled = true;
            axios.post('/dashboard/password/email', {
                email: this.email
            }).then(response => {
                swal({
                    title: response.data.message,
                    type: 'success',
                });
            }).catch(error => {
                this.form.disabled = false;
                this.form.error = true;
                if(error.response.data.errors) {
                    this.form.message = error.response.data.message;
                    this.form.validations = error.response.data.errors;
                }
            });
        }
    }
});
