@extends('layouts.app')

@section('content')
    <admins-form  :user='{!! isset($user) ? $user->toJson() : 'null' !!}' inline-template>
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ isset($user) ? 'تعديل المدير' : 'إضافة مدير' }}
                        </h3>
                    </div>
                </div>
            </div>

            <form class="m-form m-form--fit m-form--label-align-right">


                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.name }">
                                <label for="example-text-input" class="col-2 col-form-label">اسم المدير</label>
                                <div class="col-10">
                                    <input v-model="name" class="form-control m-input" type="text" >
                                    <div v-if="requestForm.error && requestForm.validations.name" class="form-control-feedback">@{{ requestForm.validations.name[0] }}</div>

                                </div>
                            </div>


                            {{--Mobile--}}
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.mobile }">
                                <label for="example-text-input" class="col-2 col-form-label">رقم الجوال</label>
                                <div class="col-10">
                                    <input v-model="mobile" class="form-control m-input" type="text" >
                                    <div v-if="requestForm.error && requestForm.validations.mobile" class="form-control-feedback">@{{ requestForm.validations.mobile[0] }}</div>

                                </div>
                            </div>

                            {{--email--}}
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.email }">
                                <label for="example-text-input" class="col-2 col-form-label"> البريد الالكتروني</label>
                                <div class="col-10">
                                    <input v-model="email" class="form-control m-input" type="email" >
                                    <div v-if="requestForm.error && requestForm.validations.email" class="form-control-feedback">@{{ requestForm.validations.email[0] }}</div>

                                </div>
                            </div>

                            {{--email--}}
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.password }">
                                <label for="example-text-input" class="col-2 col-form-label"> كلمة العبور</label>
                                <div class="col-10">
                                    <input v-model="password" class="form-control m-input" type="email" >
                                    <div v-if="requestForm.error && requestForm.validations.password" class="form-control-feedback">@{{ requestForm.validations.password[0] }}</div>

                                </div>
                            </div>


                            {{--active--}}
                            <div class="form-group m-form__group row" :class="{ 'has-danger': requestForm.error && requestForm.validations.active }">
                                <label for="example-text-input" class="col-2 col-form-label">الحالة</label>
                                <div class="col-10">
                                    <el-switch
                                            style="display: block"
                                            v-model="active"
                                            active-color="#13ce66"
                                            inactive-color="#ff4949"
                                            {{--:active-text="active ? 'فعال' : 'غير فعال'"--}}
                                    >
                                    </el-switch>

                                    <div v-if="requestForm.error && requestForm.validations.active" class="form-control-feedback">@{{ requestForm.validations.active[0] }}</div>

                                </div>
                            </div>

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
    </admins-form>
@endsection
