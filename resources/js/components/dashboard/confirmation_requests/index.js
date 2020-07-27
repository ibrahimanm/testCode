Vue.component('confirmation_requests-index', {

    mounted() {
        this.$on('userDeleted', id => {
            this.$refs.table.refresh();
        });
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get('/dashboard/confirmation_requests/data', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.users.data,
                pagination: {
                    currentPage: response.data.users.current_page,
                    totalPages: response.data.users.last_page
                }
            };
        },

        acceptRejectRequest(req_id,status){
            swal({
                title: "هل أنت متأكد من العملية",
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText:"نعم",
                cancelButtonText: __('swal Cancel'),
            }).then((result) => {
                if (result.value) {
                    axios.post('/dashboard/confirmation_requests/acceptRejectRequest',{
                        req_id : req_id,
                        status: status
                    }).then(response => {
                        this.$refs.table.refresh();
                        swal({
                            title: response.data.message,
                            timer: 2000,
                        });
                    })
                }
            })
        },

    }
})
