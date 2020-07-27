import moment from "moment/moment";

Vue.component('confirmation_req-show', {

    props: {
        req: Object,

    },
    components: {
        moment,
    },
    data(){
        return {
            modalImage: null,
       // center :{lat:order.source_lat, lng:order.source_long}
        }
    },
    mounted() {
        console.log( this.req);

    },

    methods: {
        spiltNo(str){
            var myArray = str.split(/([0-9]+)/)
            return myArray[1];

        },
        spiltstr(str){
            var myArray = str.split(/([0-9]+)/)
            console.log(myArray);
            return myArray[2];

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
        openImageModal(img){
            this.modalImage=img;
            $('#image_modal').modal('show');
        },
        closeImageModal(){
            this.modalImage=null;
            $('#image_modal').modal('hide');
        },

    },

    filters: {
        moment: function (date) {
            return moment(date).format('DD/MM/YYYY');
        }
    },
})
