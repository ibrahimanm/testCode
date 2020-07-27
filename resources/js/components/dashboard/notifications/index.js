Vue.component('notifications-index', {

    mounted() {
        // this.$on('userDeleted', id => {
        //     this.$refs.table.refresh();
        // });
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get('/dashboard/notifications/data', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.notifications.data,
                pagination: {
                    currentPage: response.data.notifications.current_page,
                    totalPages: response.data.notifications.last_page
                }
            };
        }
    }
})
