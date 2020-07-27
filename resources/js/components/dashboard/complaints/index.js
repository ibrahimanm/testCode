Vue.component('complaints-index', {
        data(){
            return  {
                reply: null,
            }
        },
    mounted() {
        // this.$on('userDeleted', id => {
        //     this.$refs.table.refresh();
        // });
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get('/dashboard/complaints/data', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.complaints.data,
                pagination: {
                    currentPage: response.data.complaints.current_page,
                    totalPages: response.data.complaints.last_page
                }
            };
        },


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
                        table.reload();
                        swal({
                            title: response.data.message,
                            timer: 2000,
                        });
                    })
                }
            })
        },

        openReplayModal(reply){
            this.reply=reply;
            console.log(this.reply);
            $('#replay_modal').modal('show');
        },
        closeReplayModal(){
            this.reply=null;
            $('#replay_modal').modal('hide');
        }

    }
})
