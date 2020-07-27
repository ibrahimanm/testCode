@extends('layouts.app')
@push('styles')
    <style>
        .help-block{
            color: #d70206;
            display: block;
        }
        .table-component__filter__field.form-control{
            margin-bottom: 20px;
        }
    </style>
    @endpush
@section('content')
    <settings-index
        :settings='{!! isset($settings) ? $settings->toJson() : 'null' !!}'
                     inline-template>
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            الاعدادات
                        </h3>
                    </div>
                </div>
            </div>


                <div class="m-portlet__body">
                <div class="row">
                    <div class="col-sm-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link h5 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">النسب</a>
                        <a class="nav-link h5" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">تسعيرة التوصيل</a>
                        <a class="nav-link h5" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">تسعيرة التاكسي</a>
                        <a class="nav-link h5" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">أكواد الخصم</a>
                        <a class="nav-link h5" id="v-pills-cars-tab" data-toggle="pill" href="#v-pills-cars" role="tab" aria-controls="v-pills-cars" aria-selected="false">السيارات </a>
                        <a class="nav-link h5" id="v-pills-models-tab" data-toggle="pill" href="#v-pills-Models" role="tab" aria-controls="v-pills-models" aria-selected="false">المودل </a>
                        <a class="nav-link h5" id="v-pills-banks-tab" data-toggle="pill" href="#v-pills-banks" role="tab" aria-controls="v-pills-banks" aria-selected="false">البنوك </a>
                        <a class="nav-link h5" id="v-pills-terms-tab" data-toggle="pill" href="#v-pills-terms" role="tab" aria-controls="v-pills-terms" aria-selected="false">الأحكام و الشروط </a>
                    </div>
                    </div>
                        <div class="col-sm-10">
                        <div class="tab-content" id="v-pills-tabContent">

                            {{--Ratio Tab--}}
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      {{--Top inputs--}}
                        <div class="m-demo">
                          <div class="m-demo__preview">
                           <div class="row">
                               <div class="col-sm-3">
                                   <div class="form-group m-form__group row">
                                       <label for="example-date-input" class="col-6 col-form-label">النسبة العامة للتوصيل</label>
                                       <div class="col-6">
                                           <input v-model="public_ratio_delivery" class="form-control m-input" type="number"  >
                                           <span v-if="requestForm.error && requestForm.validations['public_ratio_delivery']" class="help-block text-danger">@{{ requestForm.validations['public_ratio_delivery'][0] }}</span>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-sm-3">
                                   <div class="form-group m-form__group row">
                                       <label for="example-date-input" class="col-6 col-form-label">النسبة العامة للتاكسي</label>
                                       <div class="col-6">
                                           <input v-model="public_ratio_taxi" class="form-control m-input" type="number"  >
                                           <span v-if="requestForm.error && requestForm.validations['public_ratio_taxi']" class="help-block text-danger">@{{ requestForm.validations['public_ratio_taxi'][0] }}</span>

                                       </div>
                                   </div>
                               </div>
                               <div class="col-sm-3">
                                   <div class="form-group m-form__group row">
                                       <label for="example-date-input" class="col-6 col-form-label">أقصى مسافة للتوصيل</label>
                                       <div class="col-6">
                                           <input v-model="max_delivery_distance" class="form-control m-input" type="number"  >
                                           <span v-if="requestForm.error && requestForm.validations['max_delivery_distance']" class="help-block text-danger">@{{ requestForm.validations['max_delivery_distance'][0] }}</span>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-sm-3">
                                   <div class="form-group m-form__group row">
                                       <label for="example-date-input" class="col-6 col-form-label">أقصى مسافة للتاكسي</label>
                                       <div class="col-6">
                                           <input v-model="max_taxi_distance" class="form-control m-input" type="number"  >
                                           <span v-if="requestForm.error && requestForm.validations['max_taxi_distance']" class="help-block text-danger">@{{ requestForm.validations['max_taxi_distance'][0] }}</span>
                                       </div>
                                   </div>
                               </div>

                           </div>
                          </div>
                        </div>

                            {{--table--}}
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">النسب المتغيرة</h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">

                                    <button @click=" add_ratio()"  class="btn btn-primary">إضافة </button>

                                </div>
                            </div>
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table class="table m-table m-table--head-bg-brand text-center">
                                        <thead>
                                        <tr >
                                            <th>عدد الطلبات</th>
                                            <th>النسبة</th>
                                            <th>من</th>
                                            <th>إلى</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(r,index) in changing_ratio">
                                            <td>
                                            <span>أكثر من</span>
                                            <span>
                                                <input v-model="r.more_than_days" :disabled="r.disable" type="number" class="form-control" style="width: 70px;display: inline-block">
                                            </span>
                                            <span> طلبات /يوم</span>
                                                <span v-if="requestForm.error && requestForm.validations['changing_ratio.'+index+'.more_than_days']" class="help-block font-red">@{{ requestForm.validations['changing_ratio.'+index+'.more_than_days'][0] }}</span>
                                            </td>
                                            <td>
                                                <span>النسبة</span>
                                                <span>
                                                <input v-model="r.ratio"  :disabled="r.disable" min="0" type="number" class="form-control" style="width: 70px;display: inline-block">
                                            </span>
                                                <span>%</span>
                                                <span v-if="requestForm.error && requestForm.validations['changing_ratio.'+index+'.ratio']" class="help-block font-red">@{{ requestForm.validations['changing_ratio.'+index+'.ratio'][0] }}</span>

                                            </td>
                                            <td>
                                                    <el-date-picker
                                                            v-model="r.from_date"
                                                            :disabled="r.disable"
                                                            type="date"
                                                            placeholder="اختار التاريخ">
                                                    </el-date-picker>
                                                <span v-if="requestForm.error && requestForm.validations['changing_ratio.'+index+'.from_date']" class="help-block font-red">@{{ requestForm.validations['changing_ratio.'+index+'.from_date'][0] }}</span>

                                            </td>
                                            <td>
                                                <el-date-picker
                                                        v-model="r.to_date"
                                                        :disabled="r.disable"
                                                        type="date"
                                                        placeholder="اختار التاريخ">
                                                </el-date-picker>
                                                <span v-if="requestForm.error && requestForm.validations['changing_ratio.'+index+'.to_date']" class="help-block font-red">@{{ requestForm.validations['changing_ratio.'+index+'.to_date'][0] }}</span>

                                            </td>
                                            <td>
                                                <a  href="javascript:;" @click.prevent="edit_ratio(r)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                    <i class="fa fa-edit fa-lg"></i>
                                                </a>

                                                <a @click.prevent="del_ratio(r)" href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                                    <i class="fa fa-trash-o fa-lg"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <div class="row">
                                        <div class="col-lg-9 ml-lg-auto">
                                            <button @click.prevent="save()" type="submit" class="btn btn-brand">حفظ</button>
                                            <button type="submit" class="btn btn-secondary">الغاء</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            {{--Delivery Prices--}}
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="m-portlet__head-tools">

                                        <button @click="addDeliveryPriceModal()"  class="btn btn-primary">إضافة  </button>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <table-component
                                            class="table m-table m-table--head-bg-brand text-center"
                                            :data="fetchDeliveryPrices"
                                            :show-caption="false"
                                            ref="del_price_table"
                                    >

                                        <table-column show="from_distance"  label="من مسافة (كم)"> </table-column>
                                        <table-column show="to_distance"  label="الى مسافة (كم)"> </table-column>
                                        <table-column show="price"  label="السعر"> </table-column>

                                        <table-column >
                                            <template slot-scope="price">
                                                <a  href="javascript:;" @click.prevent="editPriceModal(price)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                    <i class="fa fa-edit fa-lg"></i>
                                                </a>
                                            </template>
                                        </table-column>

                                    </table-component>
                                </div>
                            </div>
                        </div>

                            {{--Taxi Prices--}}
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">سعر الدقيقة</label>
                                        <div class="col-6">
                                            <input v-model="taxi_minute_price" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_minute_price']" class="help-block text-danger">@{{ requestForm.validations['taxi_minute_price'][0] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">سعر الكيلومتر</label>
                                        <div class="col-6">
                                            <input v-model="taxi_kilometer_price" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_kilometer_price']" class="help-block text-danger">@{{ requestForm.validations['taxi_kilometer_price'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">الحد الأدنى للتوصيل</label>
                                        <div class="col-6">
                                            <input v-model="taxi_minimum_price" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_minimum_price']" class="help-block text-danger">@{{ requestForm.validations['taxi_minimum_price'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">معامل سعر السيارة العائلية</label>
                                        <div class="col-6">
                                            <input v-model="taxi_family_car_factor" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_family_car_factor']" class="help-block text-danger">@{{ requestForm.validations['taxi_family_car_factor'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">معامل سعر السيارة الفخمة</label>
                                        <div class="col-6">
                                            <input v-model="taxi_fancy_car_factor" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_fancy_car_factor']" class="help-block text-danger">@{{ requestForm.validations['taxi_fancy_car_factor'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">أقصى مدة لانتظارالعميل قبل حساب الانتظار</label>
                                        <div class="col-6">
                                            <input v-model="taxi_max_free_waiting_minute" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_max_free_waiting_minute']" class="help-block text-danger">@{{ requestForm.validations['taxi_max_free_waiting_minute'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">سعر دقيقة الانتظار</label>
                                        <div class="col-6">
                                            <input v-model="taxi_waiting_minute_price" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_waiting_minute_price']" class="help-block text-danger">@{{ requestForm.validations['taxi_waiting_minute_price'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">الحد الأقصى لعدد الدقائق قبل الالغاء المجاني</label>
                                        <div class="col-6">
                                            <input v-model="taxi_max_free_minute_before_cancellation" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_max_free_minute_before_cancellation']" class="help-block text-danger">@{{ requestForm.validations['taxi_max_free_minute_before_cancellation'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">قيمة غرامة الالغاء</label>
                                        <div class="col-6">
                                            <input v-model="taxi_cancellation_penalty_price" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_cancellation_penalty_price']" class="help-block text-danger">@{{ requestForm.validations['taxi_cancellation_penalty_price'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">قيمة غرامة الالغاء للعائلي</label>
                                        <div class="col-6">
                                            <input v-model="taxi_cancellation_penalty_family_car_price" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_cancellation_penalty_family_car_price']" class="help-block text-danger">@{{ requestForm.validations['taxi_cancellation_penalty_family_car_price'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group m-form__group row">
                                        <label for="example-date-input" class="col-6 col-form-label">قيمة غرامة الالغاء للفخمة</label>
                                        <div class="col-6">
                                            <input v-model="taxi_cancellation_penalty_fancy_car_price" class="form-control m-input" type="number"  >
                                            <span v-if="requestForm.error && requestForm.validations['taxi_cancellation_penalty_fancy_car_price']" class="help-block text-danger">@{{ requestForm.validations['taxi_cancellation_penalty_fancy_car_price'][0] }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <hr>

                            <div class="peak-times">
                                {{--table--}}
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">أسعار أوقات الذروة</h3>
                                        </div>
                                    </div>
                                    <div class="m-portlet__head-tools">

                                        <button @click=" add_taxi_peak_time()"  class="btn btn-primary">إضافة </button>

                                    </div>
                                </div>

                                <div class="m-section">
                                    <div class="m-section__content">
                                        <table class="table m-table m-table--head-bg-brand text-center">
                                            <thead>
                                            <tr >
                                                <th>من الساعة</th>
                                                <th>إلى الساعة</th>
                                                <th>اليوم</th>
                                                <th>السعر</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(r,index) in taxi_peak_times">
                                                <td>
                                                    <time-select
                                                            v-model="r.from_time"
                                                            :disabled="r.disable"
                                                            :picker-options="{
                                                                  start: '08:30',
                                                                  step: '00:15',
                                                                  end: '24:00'
                                                                }"
                                                            placeholder="اختار الوقت">
                                                    </time-select>
                                                    <span v-if="requestForm.error && requestForm.validations['taxi_peak_times.'+index+'.from_time']" class="help-block font-red">@{{ requestForm.validations['taxi_peak_times.'+index+'.from_time'][0] }}</span>

                                                </td>
                                                <td>
                                                    <time-select
                                                            v-model="r.to_time"
                                                            :disabled="r.disable"
                                                            :picker-options="{
                                                                  start: '08:30',
                                                                  step: '00:15',
                                                                  end: '24:00'
                                                                }"
                                                            placeholder="اختار الوقت">
                                                    </time-select>
                                                    <span v-if="requestForm.error && requestForm.validations['taxi_peak_times.'+index+'.to_time']" class="help-block font-red">@{{ requestForm.validations['taxi_peak_times.'+index+'.to_time'][0] }}</span>

                                                </td>
                                                <td>

                                                    <span>
                                              <el-select  :disabled="r.disable" v-model="r.day_number" placeholder="اختر اليوم">
                                                    <el-option
                                                            v-for="item in days"
                                                            :key="item.id"
                                                            :label="item.name"
                                                            :value="item.id">
                                                    </el-option>
                                                  </el-select>
                                                    </span>

                                                    <span v-if="requestForm.error && requestForm.validations['taxi_peak_times.'+index+'.day_number']" class="help-block font-red">@{{ requestForm.validations['taxi_peak_times.'+index+'.day_number'][0] }}</span>
                                                </td>
                                                <td>

                                                    <span>
                                                <input v-model="r.price"  :disabled="r.disable" min="0" type="number" class="form-control" style="width: 70px;display: inline-block">
                                                  </span>
                                                    <span v-if="requestForm.error && requestForm.validations['taxi_peak_times.'+index+'.price']" class="help-block font-red">@{{ requestForm.validations['taxi_peak_times.'+index+'.price'][0] }}</span>

                                                </td>


                                                <td>
                                                    <a  href="javascript:;" @click.prevent="edit_peak_time(r)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </a>

                                                    <a @click.prevent="del_peak_time(r)" href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                                        <i class="fa fa-trash-o fa-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br>
                                <hr>
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">أسعار المناسبات والأيام الخاصة</h3>
                                        </div>
                                    </div>
                                    <div class="m-portlet__head-tools">

                                        <button @click=" add_taxi_special_day()"  class="btn btn-primary">إضافة </button>

                                    </div>
                                </div>

                                <div class="m-section">
                                    <div class="m-section__content">
                                        <table class="table m-table m-table--head-bg-brand text-center">
                                            <thead>
                                            <tr >
                                                <th>من تاريخ</th>
                                                <th>إلى تاريخ</th>
                                                <th>السعر</th>
                                                <th>ملاحظات</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(r,index) in taxi_special_days">
                                                <td>
                                                    <el-date-picker
                                                            v-model="r.from_date"
                                                            :disabled="r.disable"
                                                            type="date"
                                                            placeholder="اختار التاريخ">
                                                    </el-date-picker>
                                                    <span v-if="requestForm.error && requestForm.validations['taxi_special_days.'+index+'.from_date']" class="help-block font-red">@{{ requestForm.validations['taxi_special_days.'+index+'.from_date'][0] }}</span>

                                                </td>
                                                <td>
                                                    <el-date-picker
                                                            v-model="r.to_date"
                                                            :disabled="r.disable"
                                                            type="date"
                                                            placeholder="اختار التاريخ">
                                                    </el-date-picker>
                                                    <span v-if="requestForm.error && requestForm.validations['taxi_special_days.'+index+'.to_date']" class="help-block font-red">@{{ requestForm.validations['taxi_special_days.'+index+'.to_date'][0] }}</span>

                                                </td>

                                                <td>

                                                    <span>
                                                <input v-model="r.price"  :disabled="t" min="0" type="number" class="form-control" style="width: 70px;display: inline-block">
                                                  </span>
                                                    <span v-if="requestForm.error && requestForm.validations['taxi_special_days.'+index+'.price']" class="help-block font-red">@{{ requestForm.validations['taxi_special_days.'+index+'.price'][0] }}</span>

                                                </td>
                                                <td>

                                                    <span>
                                                <input v-model="r.notes"  :disabled="r.disable" min="0" type="text" class="form-control" style="width: 200px;display: inline-block">
                                                  </span>
                                                    <span v-if="requestForm.error && requestForm.validations['taxi_special_days.'+index+'.notes']" class="help-block font-red">@{{ requestForm.validations['taxi_special_days.'+index+'.notes'][0] }}</span>

                                                </td>

                                                <td>
                                                    <a  href="javascript:;" @click.prevent="edit_special_day(r)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </a>

                                                    <a @click.prevent="del_special_day(r)" href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                                        <i class="fa fa-trash-o fa-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{--/////////////////////////////////--}}

                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions">
                                        <div class="row">
                                            <div class="col-lg-9 ml-lg-auto">
                                                <button @click.prevent="saveTaxiSettings()" type="submit" class="btn btn-brand">حفظ</button>
                                                <button type="submit" class="btn btn-secondary">الغاء</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                            {{--Prpmo coodes--}}
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="m-portlet__head-tools">

                                        <button @click="addPromoModal()"  class="btn btn-primary">إضافة كود خصم </button>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <table-component
                                            class="table m-table m-table--head-bg-brand text-center"
                                            :data="fetchPromoCodes"
                                            :show-caption="false"
                                            ref="promo_table"
                                    >

                                        <table-column show="code"  label="معرف الكود"> </table-column>
                                        <table-column show="ratio"  label="نسبة الخصم">
                                            <template  slot-scope="promo">
                                                <span>@{{ promo.ratio }}</span>
                                                <span>%</span>
                                            </template>
                                        </table-column>
                                        <table-column show="is_active"  label="مفعل">
                                            <template slot-scope="promo">
                                                <span v-if="promo.is_active">مفعل</span>
                                                <span v-else>غير مفعل</span>
                                            </template>
                                        </table-column>

                                        <table-column show="max_use"  label="عدد الاستعمالات">
                                            <template slot-scope="promo">
                                                <span>@{{ promo.max_use }}</span>
                                            </template>
                                        </table-column>
                                        <table-column show="max_use_per_user"  label="عدد الاستعمالات/عميل">
                                            <template slot-scope="promo">
                                                <span>@{{ promo.max_use_per_user }}</span>
                                            </template>
                                        </table-column>

                                        <table-column show="end_at"  label="تاريخ الاستعمال النهائي">
                                            <template slot-scope="promo">
                                                <span>@{{ promo.end_at| moment }}</span>
                                            </template>
                                        </table-column>

                                        <table-column >
                                            <template slot-scope="promo">
                                                <a  href="javascript:;" @click.prevent="editModal(promo)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                    <i class="fa fa-edit fa-lg"></i>
                                                </a>
                                            </template>
                                        </table-column>

                                    </table-component>
                                </div>
                            </div>
                        </div>

                            <div class="tab-pane fade" id="v-pills-cars" role="tabpanel" aria-labelledby="v-pills-cars-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="m-portlet__head-tools">

                                            <button @click="addCarModal()"  class="btn btn-primary">إضافة </button>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <table-component
                                            class="table m-table m-table--head-bg-brand text-center"
                                            :data="fetchTaxiCompany"
                                            :show-caption="false"
                                            ref="TaxiCompany_table"
                                        >

                                            <table-column show="name"  label="اسم السيارة"> </table-column>

                                            <table-column >
                                                <template slot-scope="car">
                                                    <a  href="javascript:;" @click.prevent="editModalTaxi(car)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </a>

                                                    <a href="javascript:;"  @click="getStyleTaxi(car.id)" data-toggle="modal" data-target="#m_modal_1" title="عرض الطراز"><i style="font-size: 24px;" class=" fa fa-eye fa-lg"></i></a>

                                                    <a href="javascript:;"  @click="addStyle(car.id)" data-toggle="modal" data-target="#m_modal_2" title=" اضافة الطراز"><i style="font-size: 24px;" class=" fa fa-plus-square-o fa-lg"></i></a>


                                                </template>
                                            </table-column>

                                        </table-component>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-Models" role="tabpanel" aria-labelledby="v-pills-models-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="m-portlet__head-tools">

                                            <button @click="addModelTaxi()"  class="btn btn-primary">إضافة مودل</button>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <table-component
                                            class="table m-table m-table--head-bg-brand text-center"
                                            :data="fetchTaxiModel"
                                            :show-caption="false"
                                            ref="TaxiModel_table"
                                        >

                                            <table-column show="name"  label="المودل"> </table-column>

                                            <table-column >
                                                <template slot-scope="model">
                                                    <a  href="javascript:;" @click.prevent="editTaxiModel(model)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </a>
                                                </template>
                                            </table-column>

                                        </table-component>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-banks" role="tabpanel" aria-labelledby="v-pills-banks-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="m-portlet__head-tools">

                                            <button @click="addBank()"  class="btn btn-primary">إضافة بنك</button>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <br>
                                        <table-component
                                            class="table m-table m-table--head-bg-brand text-center"
                                            :data="fetchBank"
                                            :show-caption="false"
                                            ref="Bank_table"
                                        >

                                            <table-column show="name"  label="الاسم"> </table-column>

                                            <table-column >
                                                <template slot-scope="bank">
                                                    <a  href="javascript:;" @click.prevent="editBankModel(bank)" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </a>
                                                </template>
                                            </table-column>

                                        </table-component>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-terms" role="tabpanel" aria-labelledby="v-pills-terms-tab">
                                <div class="row">

                                        <div class="form-group m-form__group row">
                                            <label for="example-date-input" class="col-6 col-form-label"> الأحكام و الشروط</label>
                                            <br>
                                            <div class="col-8">
                                                <center>
                                                    <textarea v-model="terms_and_conditions" cols="180" rows="12" class="form-control m-input" type='text'  ></textarea>

                                                </center>
                                                <span v-if="requestForm.error && requestForm.validations['terms_and_conditions']" class="help-block text-danger">@{{ requestForm.validations['terms_and_conditions'][0] }}</span>
                                            </div>

                                    </div>
                                 </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions">
                                        <div class="row">
                                            <div class="col-lg-10 ml-lg-auto">
                                               <button @click.prevent="saveTaxiSettings()" type="submit" class="btn btn-brand">حفظ</button>
                                                <button type="submit" class="btn btn-secondary">الغاء</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                  </div>
                </div>
                </div>

            {{--Add Promo code Modal        --}}
        <!-- Modal -->
            <div class="modal fade" id="promo_code_modal"  tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@{{thisPromo.id ? modal_title : 'اضافة كود خصم' }}</h5>
                            <button type="button" class="close" @click="closePromoModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label  class="form-control-label">معرف الكود</label>
                                <input v-model="thisPromo.code" type="text" class="form-control" id="recipient-name">
                                <span v-if="requestForm.error && requestForm.validations['code']" class="help-block text-danger">@{{ requestForm.validations['code'][0] }}</span>

                            </div>
                            <div class="form-group">
                                <label  class="form-control-label">نسبة الخصم</label>
                                <input v-model="thisPromo.ratio" type="number" class="form-control" >
                                <span v-if="requestForm.error && requestForm.validations['ratio']" class="help-block text-danger">@{{ requestForm.validations['ratio'][0] }}</span>

                            </div>
                            <div class="form-group">
                                <label  class="form-control-label">عدد الاستعمالات</label>
                                <input v-model="thisPromo.max_use" type="number" class="form-control" >
                                <span v-if="requestForm.error && requestForm.validations['max_use']" class="help-block text-danger">@{{ requestForm.validations['max_use'][0] }}</span>

                            </div>
                            <div class="form-group">
                                <label  class="form-control-label">عدد الاستعمالات/ عميل</label>
                                <input v-model="thisPromo.max_use_per_user" type="number" class="form-control" >
                                <span v-if="requestForm.error && requestForm.validations['max_use_per_user']" class="help-block text-danger">@{{ requestForm.validations['max_use_per_user'][0] }}</span>

                            </div>
                            <div class="form-group">
                                <label  class="form-control-label">تاريخ البداية</label>
                                <el-date-picker
                                        v-model="thisPromo.start_at"
                                        type="date"
                                        placeholder="تاريخ البداية">
                                </el-date-picker>
                                <span v-if="requestForm.error && requestForm.validations['start_at']" class="help-block text-danger">@{{ requestForm.validations['start_at'][0] }}</span>

                            </div>
                            <div class="form-group">
                                <label  class="form-control-label">تاريخ النهاية</label>
                                <el-date-picker
                                        v-model="thisPromo.end_at"
                                        type="date"
                                        placeholder="تاريخ البداية">
                                </el-date-picker>
                                <span v-if="requestForm.error && requestForm.validations['end_at']" class="help-block text-danger">@{{ requestForm.validations['end_at'][0] }}</span>

                            </div>
                            </div>
                        <div class="modal-footer">
                            <button @click.prevent="savePromo()" type="button" class="btn btn-primary">@{{ thisPromo.id ? 'تعديل' : 'حفظ' }}</button>
                            <button type="button" class="btn btn-secondary" @click="closePromoModal()">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>


        {{--Add Delivery Price Modal        --}}
        <!-- Modal -->
            <div class="modal fade" id="delivery_price_modal"  tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@{{thisPromo.id ? 'تعديل سعر' : 'اضافة  سعر' }}</h5>
                            <button type="button" class="close" @click="closePriceModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div v-if="requestForm.message" class="alert alert-danger" role="alert">
                                <strong>خطأ !</strong> @{{ requestForm.message }}
                            </div>

                            <div class="form-group">
                                <label  class="form-control-label">من مسافة</label>
                                <input :disabled="thisDelPrice.is_edit" v-model="thisDelPrice.from_distance" type="number" class="form-control" id="recipient-name">
                                <span v-if="requestForm.error && requestForm.validations['from_distance']" class="help-block text-danger">@{{ requestForm.validations['from_distance'][0] }}</span>

                            </div>
                            <div class="form-group">
                                <label  class="form-control-label">الى مسافة</label>
                                <input :disabled="thisDelPrice.is_edit" v-model="thisDelPrice.to_distance" type="number" class="form-control" id="recipient-name">
                                <span v-if="requestForm.error && requestForm.validations['to_distance']" class="help-block text-danger">@{{ requestForm.validations['to_distance'][0] }}</span>

                            </div>
                            <div class="form-group">
                                <label  class="form-control-label">السعر</label>
                                <input v-model="thisDelPrice.price" type="number" class="form-control" id="recipient-name">
                                <span v-if="requestForm.error && requestForm.validations['price']" class="help-block text-danger">@{{ requestForm.validations['price'][0] }}</span>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button @click.prevent="saveDelPrice()" type="button" class="btn btn-primary">@{{ thisPromo.id ? 'تعديل' : 'حفظ' }}</button>
                            <button type="button" class="btn btn-secondary" @click="closePriceModal()">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="taxi_modal"  tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@{{thisTaxi.id ? modal_title : 'اضافة سيارة' }}</h5>
                            <button type="button" class="close" @click="closeTaxiModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label  class="form-control-label"> الاسم</label>
                                <input v-model="thisTaxi.name" type="text" class="form-control" id="recipient-name">
                                <span v-if="requestForm.error && requestForm.validations['name']" class="help-block text-danger">@{{ requestForm.validations['name'][0] }}</span>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click.prevent="saveTaxi()" type="button" class="btn btn-primary">@{{ thisTaxi.id ? 'تعديل' : 'حفظ' }}</button>
                            <button type="button" class="btn btn-secondary" @click="closeTaxiModal()">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">الطراز</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">الاسم</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="style in styles">
                                    <td>@{{ style.name }}</td>
                                    <td><a href="javascript:;"  @click="editStyle(style)" data-toggle="modal" data-target="#m_modal_2" title="تعديل الطراز">
                                            <i style="font-size: 24px;" class=" fa fa-edit fa-lg"></i></a>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@{{thisStyle.id ? modal_title : ' اضافة طراز' }}</h5>
                            <button type="button" class="close" @click="closeStyleModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label  class="form-control-label"> الاسم</label>
                                <input v-model="thisStyle.name" type="text" class="form-control" id="recipient-name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click.prevent="saveStyleModal()" type="button" class="btn btn-primary">@{{ thisStyle.id ? 'تعديل' : 'حفظ' }}</button>
                            <button type="button" class="btn btn-secondary" @click="closeStyleModal()">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="model_taxi_modal"  tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@{{thisModel.id ? modal_title : 'اضافة مودل' }}</h5>
                            <button type="button" class="close" @click="closeModelTaxiModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label  class="form-control-label"> الاسم</label>
                                <input v-model="thisModel.name" type="text" class="form-control" id="recipient-name">
                                <span v-if="requestForm.error && requestForm.validations['name']" class="help-block text-danger">@{{ requestForm.validations['name'][0] }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click.prevent="saveTaxiModel()" type="button" class="btn btn-primary">@{{ thisModel.id ? 'تعديل' : 'حفظ' }}</button>
                            <button type="button" class="btn btn-secondary" @click="closeModelTaxiModal()">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="bank_modal"  tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@{{thisBank.id ? modal_title : 'اضافة بنك' }}</h5>
                            <button type="button" class="close" @click="closeBankModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label  class="form-control-label"> الاسم</label>
                                <input v-model="thisBank.name" type="text" class="form-control" id="recipient-name">
                                <span v-if="requestForm.error && requestForm.validations['name']" class="help-block text-danger">@{{ requestForm.validations['name'][0] }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click.prevent="saveBankModal()" type="button" class="btn btn-primary">@{{ thisBank.id ? 'تعديل' : 'حفظ' }}</button>
                            <button type="button" class="btn btn-secondary" @click="closeBankModal()">الغاء</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </settings-index>
@endsection
