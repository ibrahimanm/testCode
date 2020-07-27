@extends('layouts.app')

@section('content')
    <drivers-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">السائقين</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">


                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                        <table-component
                            :data="fetchData"
                            :show-caption="false"
                            ref="table"
                        >

                            <table-column show="name" label="الاسم ">
                                <template slot-scope="delegate">
                                    <a :href="'/dashboard/drivers/'+delegate.id" >@{{ delegate.name }}</a>

                                </template>
                            </table-column>
                            <table-column show="mobile" label="رقم الجوال "></table-column>
                            <table-column show="email" label="البريد الالكتروني "></table-column>
                            <table-column label="الجنس">
                                <template slot-scope="user">
                                    <span v-if="user.gender == 'male'" >ذكر</span>
                                    <span v-else >أنثى</span>
                                </template>
                            </table-column>
                            <table-column  label="الحالة">
                                <template slot-scope="user">
                                    <span v-if="user.active == 1" class="m-badge m-badge--success m-badge--wide">فعال</span>
                                    <span v-else class="m-badge m-badge--danger m-badge--wide">غير فعال</span>
                                </template>
                            </table-column>
                            <table-column  label="تاريخ التوثيق  ">
                                <template slot-scope="user">
                                    <span v-if="user.confirmation_date" >@{{ user.confirmation_date }}</span>
                                    <span v-else >غير موثق</span>
                                </template>
                            </table-column>
                            <table-column show="budget" label="الرصيد  "></table-column>
                            <table-column label="" :sortable="false" :filterable="false">
                                <template slot-scope="user">

                                    <a :href="'/dashboard/drivers/'+user.id" class="btn btn-outline-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                        <i class="fa fa-file-alt fa-lg"></i>
                                    </a>
                                    <a :href="'/dashboard/drivers/'+user.id+'/changeActive'" >
                                        <span v-if="user.active == 1" ><i class="fas fa-toggle-off fa-2x" style="color: red;"></i></span>
                                        <span v-else ><i class="fas fa-toggle-on fa-2x" style="color: green;"></i></span>
                                    </a>
{{--                                    <a @click="deleteItem(user.id, `/dashboard/drivers/${user.id}`, 'userDeleted')" href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">--}}
{{--                                        <i class="fa fa-trash-o fa-lg"></i>--}}
{{--                                    </a>--}}

                                </template>
                            </table-column>
                        </table-component>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </drivers-index>
@endsection
