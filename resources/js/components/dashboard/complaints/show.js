import moment from "moment/moment";

Vue.component('complaint-show', {

    props: {
        complaint: Object,

    },
    components: {
        moment,
    },
    data(){
        return {
            modalImage: null,
            admin_notes: null,
       // center :{lat:order.source_lat, lng:order.source_long}
        }
    },
    mounted() {

    },

    methods: {

        openCloseComplaint(id,status){
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
                    axios.post('/dashboard/complaints/openCloseComplaint',{
                        id : this.complaint.id,
                        status: status,
                        admin_notes: this.admin_notes
                    }).then(response => {
                        location.reload();
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
        }
    },

    filters: {
        moment: function (date) {
            return moment(date).format('DD/MM/YYYY');
        }
    },
})
