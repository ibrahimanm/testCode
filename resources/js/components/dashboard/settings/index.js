import {DatePicker} from 'element-ui';
import {TimeSelect} from 'element-ui';
import {Select} from 'element-ui';
import moment from 'moment';

Vue.component('settings-index', {

    props: {
        settings: Object,

    },

    data() {
        return {
            thisStyle:{
                id:null,
                company_id:null,
                name:null,
            },
            thisBank:{
                id:null,
                name:null,
            },
            styles :null,
            public_ratio_delivery: 0,
            public_ratio_taxi: 0,
            terms_and_conditions:null,
            max_delivery_distance: 0,
            max_taxi_distance: 0,
            date: null,
            changing_ratio: [],
            thisPromo:{
                id:null,
                ratio:null,
                is_active:1,
                max_use:null,
                max_use_per_user:null,
                code:null,
                start_at:null,
                end_at:null,
            },
            thisDelPrice:{
                id:null,
                from_distance:null,
                to_distance:null,
                price:null,
                is_edit:false,
            },
            thisTaxi:{
                id:null,
                name:null,
            },
            thisModel:{
                id:null,
                name:null,
            },
            modal_title:null,
            response:null,

            taxi_minute_price: 0,
            taxi_kilometer_price: 0,
            taxi_minimum_price: 0,
            taxi_family_car_factor: 0,
            taxi_fancy_car_factor: 0,
            taxi_max_free_waiting_minute: 0,
            taxi_waiting_minute_price: 0,
            taxi_cancellation_penalty_price: 0,
            taxi_cancellation_penalty_family_car_price: 0,
            taxi_cancellation_penalty_fancy_car_price: 0,
            taxi_max_free_minute_before_cancellation: 0,

            taxi_peak_times:[],
            taxi_special_days:[],
            days:[
                {id:6, name:'السبت'},
                {id:0, name:'الأحد'},
                {id:1, name:'الاثنين'},
                {id:2, name:'الثلاثاء'},
                {id:3, name:'الأربعاء'},
                {id:4, name:'الخميس'},
                {id:5, name:'الجمعة'}
            ],
        }
    },

    mounted() {
        this.loadData();
        this.load_taxi_peak_times();
        if(this.settings) {
            this.public_ratio_delivery = this.settings.public_ratio_delivery;
            this.public_ratio_taxi = this.settings.public_ratio_taxi;
            this.max_delivery_distance = this.settings.max_delivery_distance;
            this.max_taxi_distance = this.settings.max_taxi_distance;
            this.terms_and_conditions = this.settings.terms_and_conditions;
        }

    },

    methods: {

        async fetchPromoCodes({ page, filter, sort }) {
            const response = await axios.get('/dashboard/settings/promocodes', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.promocodes.data,
                pagination: {
                    currentPage: response.data.promocodes.current_page,
                    totalPages: response.data.promocodes.last_page
                }
            };
        },
        async fetchDeliveryPrices({ page, filter, sort }) {
            const response = await axios.get('/dashboard/settings/delivery_prices', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.prices.data,
                pagination: {
                    currentPage: response.data.prices.current_page,
                    totalPages: response.data.prices.last_page
                }
            };
        },

        async fetchTaxiCompany({ page, filter, sort }) {
            const response = await axios.get('/dashboard/settings/TaxiCompany', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.taxies.data,
                pagination: {
                    currentPage: response.data.taxies.current_page,
                    totalPages: response.data.taxies.last_page
                }
            };
        },

        async fetchTaxiModel({ page, filter, sort }) {
            const response = await axios.get('/dashboard/settings/TaxiModel', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.models.data,
                pagination: {
                    currentPage: response.data.models.current_page,
                    totalPages: response.data.models.last_page
                }
            };
        },

        async fetchBank({ page, filter, sort }) {
            const response = await axios.get('/dashboard/settings/bank', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.banks.data,
                pagination: {
                    currentPage: response.data.banks.current_page,
                    totalPages: response.data.banks.last_page
                }
            };
        },


        add_taxi_peak_time(){
            this.taxi_peak_times.push({id:0,from_time:null,to_time:null,day_number:null,price:0,disable:false})
        },

        add_taxi_special_day(){
            this.taxi_special_days.push({id:0,from_date:null,to_date:null,notes:null,price:0,disable:false})
        },

        add_ratio(){
            this.changing_ratio.push({id:0,more_than_days:null,ratio:0,from_date:null,to_date:null,disable:false})
        },

        del_ratio(item){

            if(item.id==0) {
                this.changing_ratio.splice(this.changing_ratio.indexOf(item), 1);
            }else{
                axios.delete('/dashboard/settings/dellRatio/'+item.id).then(response => {
                    this.loadData();
                    swal({
                        title: response.data.message,
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            }

        },

        edit_ratio(item){
            this.changing_ratio[this.changing_ratio.indexOf(item)].disable=false;
        },

        loadData(){
            axios.get('/dashboard/settings/getRatio').then(response => {
                if(response.data.setting){
                    this.public_ratio_delivery=response.data.setting.public_ratio_delivery;
                    this.public_ratio_taxi=response.data.setting.public_ratio_taxi;
                    this.max_delivery_distance=response.data.setting.max_delivery_distance;
                    this.max_taxi_distance=response.data.setting.max_taxi_distance;

                    this.taxi_minute_price=response.data.setting.taxi_minute_price;
                    this.taxi_kilometer_price=response.data.setting.taxi_kilometer_price;
                    this.taxi_minimum_price=response.data.setting.taxi_minimum_price;
                    this.taxi_family_car_factor=response.data.setting.taxi_family_car_factor;
                    this.taxi_fancy_car_factor=response.data.setting.taxi_fancy_car_factor;
                    this.taxi_max_free_waiting_minute=response.data.setting.taxi_max_free_waiting_minute;
                    this.taxi_waiting_minute_price=response.data.setting.taxi_waiting_minute_price;
                    this.taxi_cancellation_penalty_price=response.data.setting.taxi_cancellation_penalty_price;
                    this.taxi_cancellation_penalty_family_car_price=response.data.setting.taxi_cancellation_penalty_family_car_price;
                    this.taxi_cancellation_penalty_fancy_car_price=response.data.setting.taxi_cancellation_penalty_fancy_car_price;
                    this.taxi_max_free_minute_before_cancellation=response.data.setting.taxi_max_free_minute_before_cancellation;
                }
                this.changing_ratio=response.data.ratio;
            });


        },

        load_taxi_peak_times(){
            axios.get('/dashboard/settings/taxi_peak_times').then(response => {
                this.taxi_peak_times=response.data.taxi_peak_times;
                this.taxi_special_days=response.data.taxi_special_days;
            });
        },

        del_peak_time(item){

            if(item.id==0) {
                this.taxi_peak_times.splice(this.taxi_peak_times.indexOf(item), 1);
            }else{
                axios.delete('/dashboard/settings/dellPeakTime/'+item.id).then(response => {
                    this.load_taxi_peak_times();
                    swal({
                        title: response.data.message,
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            }

        },

        del_special_day(item){

            if(item.id==0) {
                this.taxi_special_days.splice(this.taxi_special_days.indexOf(item), 1);
            }else{
                axios.delete('/dashboard/settings/dellSpecialDay/'+item.id).then(response => {
                    this.load_taxi_peak_times();
                    swal({
                        title: response.data.message,
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            }

        },

        edit_peak_time(item){
            this.taxi_peak_times[this.taxi_peak_times.indexOf(item)].disable=false;
        },

        edit_special_day(item){
            this.taxi_special_days[this.taxi_special_days.indexOf(item)].disable=false;
        },

        save() {
            this.saveForm('/dashboard/settings/saveRatio','POST',null,{
                changing_ratio: this.changing_ratio,
                public_ratio_delivery: this.public_ratio_delivery,
                public_ratio_taxi: this.public_ratio_taxi,
                max_delivery_distance: this.max_delivery_distance,
                max_taxi_distance: this.max_taxi_distance,
            });

        },

        saveTaxiSettings() {
            this.saveForm('/dashboard/settings/saveTaxiSettings','POST',null,{
                taxi_peak_times: this.taxi_peak_times,
                taxi_special_days: this.taxi_special_days,
                taxi_minute_price: this.taxi_minute_price,
                taxi_kilometer_price: this.taxi_kilometer_price,
                taxi_minimum_price: this.taxi_minimum_price,
                taxi_family_car_factor: this.taxi_family_car_factor,
                taxi_fancy_car_factor: this.taxi_fancy_car_factor,
                taxi_max_free_waiting_minute: this.taxi_max_free_waiting_minute,
                taxi_waiting_minute_price: this.taxi_waiting_minute_price,
                taxi_cancellation_penalty_price: this.taxi_cancellation_penalty_price,
                taxi_cancellation_penalty_family_car_price: this.taxi_cancellation_penalty_family_car_price,
                taxi_cancellation_penalty_fancy_car_price: this.taxi_cancellation_penalty_fancy_car_price,
                taxi_max_free_minute_before_cancellation: this.taxi_max_free_minute_before_cancellation,
                terms_and_conditions: this.terms_and_conditions,
            });

        },

        addPromoModal(){
        $('#promo_code_modal').modal('show');
        },
        addCarModal(){
            $('#taxi_modal').modal('show');
        },
        addModelTaxi(){
            $('#model_taxi_modal').modal('show');
        },
        editModal(promocode){
            //this.thisPromo=promocode;

            this.thisPromo.id=promocode.id;
            this.thisPromo.ratio=promocode.ratio;
            this.thisPromo.is_active=promocode.is_active;
            this.thisPromo.code=promocode.code;
            this.thisPromo.max_use=promocode.max_use;
            this.thisPromo.max_use_per_user=promocode.max_use_per_user;
            this.thisPromo.start_at=promocode.start_at;
            this.thisPromo.end_at=promocode.end_at;

            this.modal_title='بروموكود رقم '+'('+this.thisPromo.code+')';
            $('#promo_code_modal').modal('show');
        },
        editModalTaxi(car){
            //this.thisPromo=promocode;
            this.thisTaxi.id=car.id;
            this.thisTaxi.name=car.name;
            this.modal_title='السيارة'+'('+this.thisTaxi.name+')';
            $('#taxi_modal').modal('show');
        },

        editTaxiModel(model){
            //this.thisPromo=promocode;
            this.thisModel.id=model.id;
            this.thisModel.name=model.name;
            this.modal_title='المودل'+'('+this.thisModel.name+')';
            $('#model_taxi_modal').modal('show');
        },


        closePromoModal(){
            this.thisPromo.id=null;
            this.thisPromo.ratio=null;
            this.thisPromo.is_active=null;
            this.thisPromo.code=null;
            this.thisPromo.max_use=null;
            this.thisPromo.max_use_per_user=null;
            this.thisPromo.start_at=null;
            this.thisPromo.end_at=null;

            this.requestForm.validations = [];
            this.requestForm.message = '';
            this.requestForm.error = false;

            $('#promo_code_modal').modal('hide');
        },

        closeTaxiModal(){
            this.thisTaxi.id=null;
            this.thisTaxi.name=null;
            $('#taxi_modal').modal('hide');
        },

        closeModelTaxiModal(){
            this.thisModel.id=null;
            this.thisModel.name=null;
            $('#model_taxi_modal').modal('hide');
        },

        savePromo(){
            if(!this.thisPromo.id){
                axios.post('/dashboard/settings/promocodes',{
                    ratio : this.thisPromo.ratio,
                    code : this.thisPromo.code,
                    max_use : this.thisPromo.max_use,
                    max_use_per_user : this.thisPromo.max_use_per_user,
                    start_at : this.thisPromo.start_at,
                    end_at : this.thisPromo.end_at,
                }).then(response => {
                    this.$refs.promo_table.refresh();
                    this.closePromoModal();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
            else {
                axios.put('/dashboard/settings/promocodes/'+this.thisPromo.id,{
                    ratio : this.thisPromo.ratio,
                    code : this.thisPromo.code,
                    max_use : this.thisPromo.max_use,
                    max_use_per_user : this.thisPromo.max_use_per_user,
                    start_at : this.thisPromo.start_at,
                    end_at : this.thisPromo.end_at,
                }).then(response => {
                    this.closePromoModal();
                    this.$refs.promo_table.refresh();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
                }
        },
        saveTaxi(){
            if(!this.thisTaxi.id){
                axios.post('/dashboard/settings/TaxiCompany',{
                    name : this.thisTaxi.name,
                }).then(response => {
                    this.$refs.TaxiCompany_table.refresh();
                    this.closeTaxiModal();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
            else {
                axios.put('/dashboard/settings/TaxiCompany/'+this.thisTaxi.id,{
                    name : this.thisTaxi.name,
                }).then(response => {
                    this.closeTaxiModal();
                    this.$refs.TaxiCompany_table.refresh();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
        },
        saveTaxiModel(){
            if(!this.thisModel.id){
                axios.post('/dashboard/settings/TaxiModel',{
                    name : this.thisModel.name,
                }).then(response => {
                    this.$refs.TaxiModel_table.refresh();
                    this.closeModelTaxiModal();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
            else {
                axios.put('/dashboard/settings/TaxiModel/'+this.thisModel.id,{
                    name : this.thisModel.name,
                }).then(response => {
                    this.closeModelTaxiModal();
                    this.$refs.TaxiModel_table.refresh();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
        },

        addDeliveryPriceModal(){
            $('#delivery_price_modal').modal('show');
        },


        editPriceModal(price){
            this.thisDelPrice=price;
            this.thisDelPrice.is_edit=true;
            $('#delivery_price_modal').modal('show');
        },

        closePriceModal(){
            this.thisDelPrice.id=null;
            this.thisDelPrice.from_distance=null;
            this.thisDelPrice.to_distance=null;
            this.thisDelPrice.price=null;
            this.thisDelPrice.is_edit=false;

            this.requestForm.validations = [];
            this.requestForm.message = '';
            this.requestForm.error = false;

            $('#delivery_price_modal').modal('hide');
        },

        saveDelPrice(){
            if(!this.thisDelPrice.id){
                axios.post('/dashboard/settings/delivery_prices',{
                    from_distance : this.thisDelPrice.from_distance,
                    to_distance : this.thisDelPrice.to_distance,
                    price : this.thisDelPrice.price,

                }).then(response => {
                    this.$refs.del_price_table.refresh();
                    this.closePriceModal();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = __(error.response.data.message);
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
            else {
                axios.put('/dashboard/settings/delivery_prices/'+this.thisDelPrice.id,{
                    price : this.thisDelPrice.price,

                }).then(response => {
                    this.closePriceModal();
                    this.$refs.del_price_table.refresh();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
        },

        getStyleTaxi(id){
            axios.get('/dashboard/settings/TaxiStyle/'+id).then(response => {
                this.styles= response.data.styles;
                this.company_id=id;
            })
        },

        editStyle(style){
            this.thisStyle.id=style.id;
            this.thisStyle.name=style.name;
            this.thisStyle.company_id=style.company_id;
    },
        addStyle(id){
            this.thisStyle.company_id=id;
        },
        closeStyleModal(){

            this.thisStyle.name=null;
            $('#m_modal_2').modal('hide');
            $('#m_modal_1').modal('hide');

        },

        saveStyleModal(){
            if(!this.thisStyle.id){
                axios.post('/dashboard/settings/style',{
                    name : this.thisStyle.name,
                    company_id :this.thisStyle.company_id,
                }).then(response => {
                    this.$refs.TaxiCompany_table.refresh();
                    this.closeStyleModal();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
            else {
                axios.put('/dashboard/settings/style/'+this.thisStyle.id,{
                    name : this.thisStyle.name,
                    company_id :this.thisStyle.company_id,
                }).then(response => {
                    this.$refs.TaxiCompany_table.refresh();
                    this.closeStyleModal();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
        },
        addBank(){
            $('#bank_modal').modal('show');
        },
        editBankModel(bank){
            //this.thisPromo=promocode;
            this.thisBank.id=bank.id;
            this.thisBank.name=bank.name;
            this.modal_title='البنك'+'('+this.thisBank.name+')';
            $('#bank_modal').modal('show');
        },
        closeBankModal(){
            this.thisBank.id=null;
            this.thisBank.name=null;
            $('#bank_modal').modal('hide');
        },
        saveBankModal(){
            if(!this.thisBank.id){
                axios.post('/dashboard/settings/bank',{
                    name : this.thisBank.name,
                }).then(response => {
                    this.$refs.Bank_table.refresh();
                    this.closeBankModal();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
            else {
                axios.put('/dashboard/settings/bank/'+this.thisBank.id,{
                    name : this.thisBank.name,
                }).then(response => {
                    this.closeBankModal();
                    this.$refs.Bank_table.refresh();
                }).catch(error => {
                    this.requestForm.disabled = false;
                    this.requestForm.error = true;
                    if(error.response.data.errors) {
                        this.requestForm.message = error.response.data.message;
                        this.requestForm.validations = error.response.data.errors;
                    }
                    else if(error.response.data.message) {
                        this.requestForm.validations = [];
                        this.requestForm.message = error.response.data.message;
                    }
                });
            }
        },
    },
    filters: {
        moment: function (date) {
            return moment(date).format('DD/MM/YYYY');
        }
    },
    components: {
        moment,
        'el-date-picker': DatePicker,
        'el-Select': Select,
        'time-select': TimeSelect,
    }
});
