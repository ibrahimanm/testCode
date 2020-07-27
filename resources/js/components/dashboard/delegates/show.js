import moment from "moment/moment";

Vue.component('delegates-show', {

    props: {
        delegate: Object,

    },
    components: {
        moment
    },
    data(){
        return {
            modalImage: null,
        }
    },
    mounted() {

    },

    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get('/dashboard/delegates/getOrders/'+this.delegate.id, {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.orders.data,
                pagination: {
                    currentPage: response.data.orders.current_page,
                    totalPages: response.data.orders.last_page
                }
            };
        },

        async fetchComments({ page, filter, sort }) {
            const response = await axios.get('/dashboard/delegates/getComments/'+this.delegate.id, {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.orders.data,
                pagination: {
                    currentPage: response.data.orders.current_page,
                    totalPages: response.data.orders.last_page
                }
            };
        },

        async fetchComplaints({ page, filter, sort }) {
            const response = await axios.get('/dashboard/delegates/getComplaints/'+this.delegate.id, {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.orders.data,
                pagination: {
                    currentPage: response.data.orders.current_page,
                    totalPages: response.data.orders.last_page
                }
            };
        },

        async fetchPayments({ page, filter, sort }) {
            const response = await axios.get('/dashboard/delegates/getPayments/'+this.delegate.id, {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.orders.data,
                pagination: {
                    currentPage: response.data.orders.current_page,
                    totalPages: response.data.orders.last_page
                }
            };
        },

        openImageModal(img){
            this.modalImage=img;
            $('#image_modal').modal('show');
        },
        closeImageModal(){
            this.modalImage=null;
            $('#image_modal').modal('hide');
        }
    },

    filters: {
        moment: function (date) {
            return moment(date).format('DD/MM/YYYY');
        }
    },
})
