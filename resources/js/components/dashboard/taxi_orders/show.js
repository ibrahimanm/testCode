import moment from "moment/moment";
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyC2oDMLf_aZCvI9F-JpTqg7YriZmAXsB4g',
        libraries: 'places', // This is required if you use the Autocomplete plugin
        language: 'ar',
    },


})

Vue.component('taxi-orders-show', {

    props: {
        order: Object,

    },
    components: {
        moment,
        VueGoogleMaps
    },
    data(){
        return {
            modalImage: null,
       // center :{lat:order.source_lat, lng:order.source_long}
        }
    },
    mounted() {
        this.$refs.myMap.$mapPromise.then((map) => {
            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();


            directionsDisplay.setMap(map);
            // 31.514516, 34.450771
            // 31.526260, 34.447767
            var from = new google.maps.LatLng(parseFloat(this.order.source_lat), parseFloat(this.order.source_long));
            var to = new google.maps.LatLng(parseFloat(this.order.destination_lat), parseFloat(this.order.destination_long));
            var request = {
                origin: from,
                destination: to,
                // Note that Javascript allows us to access the constant
                // using square brackets and a string value as its
                // "property."
                travelMode: 'DRIVING'
            };
            directionsService.route(request, (response, status) => {
                if (status == 'OK') {
                    directionsDisplay.setDirections(response);
                }
            });
        })
    },

    methods: {
        async fetchComments({ page, filter, sort }) {
            const response = await axios.get('/dashboard/taxi_orders/getComments/'+this.order.id, {params: { page, filter, sort }});
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
            const response = await axios.get('/dashboard/taxi_orders/getComplaints/'+this.order.id, {params: { page, filter, sort }});
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
