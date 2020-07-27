Vue.component('admins-index', {

    mounted() {
        this.$on('userDeleted', id => {
            this.$refs.table.refresh();
        });
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get('/dashboard/admins/data', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.users.data,
                pagination: {
                    currentPage: response.data.users.current_page,
                    totalPages: response.data.users.last_page
                }
            };
        }
    }
})
