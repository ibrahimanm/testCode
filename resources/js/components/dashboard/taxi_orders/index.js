Vue.component('taxi-orders-index', {

    mounted() {
        // this.$on('userDeleted', id => {
        //     this.$refs.table.refresh();
        // });
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get('/dashboard/taxi_orders/data', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.orders.data,
                pagination: {
                    currentPage: response.data.orders.current_page,
                    totalPages: response.data.orders.last_page
                }
            };
        }
    }
})
