export default {
    data() {
        return {
            requestForm: {
                disabled: false,
                error: false,
                validations: [],
                message: null,
            },
        }
    },
    methods: {
        __(key, replace) {
            return __(key, replace);
        },
        saveForm(url, method, redirect, $data) {
            this.requestForm.disabled = true;
            axios({
                method: method,
                url: url,
                data: $data
            }).then(response => {
                this.$emit('formSaved', response);
                swal({
                    title: response.data.message,
                    type: 'success',
                    timer: 2000,
                });
                setTimeout(()=>{
                    if(redirect !== null) {
                        location.href = redirect;
                    }
                    else {
                        this.requestForm.disabled = false;
                    }
                }, 2000)
            }).catch(error => {
                this.requestForm.disabled = false;
                this.requestForm.error = true;
                if(error.response.data.errors) {
                    this.requestForm.message = error.response.data.message;
                    this.requestForm.validations = error.response.data.errors;
                }
                else if(error.response.data.message) {
                    this.requestForm.validations = [];
                    this.requestForm.message = error.response.data.message;
                }
                document.body.scrollTop = 0; // For Chrome, Safari and Opera
                document.documentElement.scrollTop = 0; // For IE and Firefox
            })
        },

        deleteItem(id, url, event=null) {
            swal({
                title: __('swal Are you sure'),
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: __('swal Yes, delete it'),
                cancelButtonText: __('swal Cancel'),
            }).then((result) => {
                if (result.value) {
                    axios.delete(url).then(response => {
                        if(event != null) {
                            this.$emit(event, id);
                        }
                        swal({
                            title: response.data.message,
                            timer: 2000,
                        });
                    })
                }
            })
        },
    }
}
