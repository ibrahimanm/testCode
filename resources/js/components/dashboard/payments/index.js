import moment from "moment/moment";

Vue.component('payments-index', {

    mounted() {
        // this.$on('userDeleted', id => {
        //     this.$refs.table.refresh();
        // });
    },
    components: {
        moment
    },
    filters: {
        moment: function (date) {
            return moment(date).format('DD/MM/YYYY');
        }
    },
    methods: {
        async fetchData({page, filter, sort}) {
            const response = await axios.get('/dashboard/payments/data', {params: {page, filter, sort}});
            this.loading = false;
            return {
                data: response.data.payments.data,
                pagination: {
                    currentPage: response.data.payments.current_page,
                    totalPages: response.data.payments.last_page
                }
            };
        },
        confirm(id) {
            axios.post('payments/confirm', {
                id: id,
            }).then(response => {
                response.data;
                this.$refs.table.refresh();
            });
        }
    }
})
