@extends('layouts.app')

@section('content')
    <payment-form  inline-template>
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                           اضافة دفعة
                        </h3>
                    </div>
                </div>
            </div>

            <form class="m-form m-form--fit m-form--label-align-right">


                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.type }">
                                <label for="example-text-input" class="col-3 col-form-label">نوع العملية</label>
                                <div class="col-9">
                                    <el-select v-model="type" class="" placeholder="اختر نوع العملية">
                                        <el-option
                                                v-for="item in options"
                                                :key="item.value"
                                                :label="item.name"
                                                :value="item.value">
                                        </el-option>
                                    </el-select>
                                    <div v-if="requestForm.error && requestForm.validations.type" class="form-control-feedback">@{{ requestForm.validations.type[0] }}</div>

                                </div>
                            </div>


                            {{--Mobile--}}
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.value }">
                                <label for="example-text-input" class="col-3 col-form-label">المبلغ</label>
                                <div class="col-9">
                                    <input v-model="value" class="form-control m-input" type="number" >
                                    <div v-if="requestForm.error && requestForm.validations.value" class="form-control-feedback">@{{ requestForm.validations.value[0] }}</div>

                                </div>
                            </div>

                            {{--email--}}
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.user_type }">
                                <label for="example-text-input" class="col-3 col-form-label">مندوب / سائق</label>
                                <div class="col-9">
                                    <el-radio v-model="user_type" label="delegate">&nbsp; مندوب &nbsp;</el-radio>
                                    <el-radio v-model="user_type" label="driver">&nbsp;سائق &nbsp;</el-radio>
                                    <div v-if="requestForm.error && requestForm.validations.user_type" class="form-control-feedback">@{{ requestForm.validations.user_type[0] }}</div>

                                </div>
                            </div>

                            {{--email--}}
                            <div v-if="user_type=='delegate'" class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.delegate }">
                                <label for="example-text-input" class="col-3 col-form-label"> المندوب</label>
                                <div class="col-9">
                                    <el-select v-model="delegate"  filterable :remote-method="getDelegates" remote class="" placeholder="اختر المندوب">
                                        <el-option
                                                v-for="item in delegates_list"
                                                :key="item.value"
                                                :label="item.name"
                                                :value="item.value">
                                        </el-option>
                                    </el-select>
                                    <div v-if="requestForm.error && requestForm.validations.delegate" class="form-control-feedback">@{{ requestForm.validations.delegate[0] }}</div>

                                </div>
                            </div>

                            <div v-if="user_type=='driver'" class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.driver }">
                                <label for="example-text-input" class="col-3 col-form-label"> السائق</label>
                                <div class="col-9">
                                    <el-select v-model="driver" filterable :remote-method="getDrivers" remote reserve-keyword class="" placeholder="اختر السائق">
                                        <el-option
                                                v-for="item in drivers_list"
                                                :key="item.value"
                                                :label="item.name"
                                                :value="item.value">
                                        </el-option>
                                    </el-select>
                                    <div v-if="requestForm.error && requestForm.validations.driver" class="form-control-feedback">@{{ requestForm.validations.driver[0] }}</div>

                                </div>
                            </div>

                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.payment_method }">
                                <label for="example-text-input" class="col-3 col-form-label"> طريقة الدفع</label>
                                <div class="col-9">
                                    <el-select v-model="payment_method" class="" placeholder="اختر طريقة الدفع">
                                        <el-option
                                                v-for="item in [{value:'cash',name:'كاش'},{value:'visa',name:'فيزا'},{value:'bank_transfer',name:'حوالة بنكية'}]"
                                                :key="item.value"
                                                :label="item.name"
                                                :value="item.value">
                                        </el-option>
                                    </el-select>
                                    <div v-if="requestForm.error && requestForm.validations.payment_method" class="form-control-feedback">@{{ requestForm.validations.payment_method[0] }}</div>

                                </div>
                            </div>

                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.image }">
                                <label for="example-text-input" class="col-3 col-form-label"> صورة الايداع</label>
                                <div class="col-9">
                                    <upload
                                            class="avatar-uploader"
                                            action="/uploads"
                                            :show-file-list="false"
                                            :on-success="handleAvatarSuccess"
                                            :before-upload="()=>{this.avatarLoading=true;}">
                                        <img v-if="image" :src="'/storage/'+image" class="avatar-uploader-avatar">
                                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                    </upload>
                                    <div v-if="requestForm.error && requestForm.validations.image" class="form-control-feedback">@{{ requestForm.validations.image[0] }}</div>

                                </div>
                            </div>


                            {{--active--}}
                            {{--<div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.active }">--}}
                                {{--<label for="example-text-input" class="col-2 col-form-label">الحالة</label>--}}
                                {{--<div class="col-10">--}}
                                    {{--<el-switch--}}
                                            {{--style="display: block"--}}
                                            {{--v-model="active"--}}
                                            {{--active-color="#13ce66"--}}
                                            {{--inactive-color="#ff4949"--}}
                                            {{--:active-text="active ? 'فعال' : 'غير فعال'"--}}
                                    {{-->--}}
                                    {{--</el-switch>--}}

                                    {{--<div v-if="requestForm.error && requestForm.validations.active" class="form-control-feedback">@{{ requestForm.validations.active[0] }}</div>--}}

                                {{--</div>--}}
                            {{--</div>--}}

                        </div>
                    </div>

                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <button @click.prevent="save" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="{{ url('dashboard/admins') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </payment-form>
@endsection
