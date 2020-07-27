@extends('layouts.app')

@section('content')
    <admins-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">المديرين</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">

                    <a href="{{ url('dashboard/admins/create') }}" class="btn btn-primary">إضافة مدير</a>

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

                            <table-column show="name" label="الاسم "></table-column>
                            <table-column show="mobile" label="رقم الجوال "></table-column>
                            <table-column show="email" label="البريد الالكتروني "></table-column>

                            <table-column show="active" label="الحالة">
                                <template slot-scope="user">
                                    <span v-if="user.active == 1" class="m-badge m-badge--success m-badge--wide">فعال</span>
                                    <span v-else class="m-badge m-badge--danger m-badge--wide">غير فعال</span>
                                </template>
                            </table-column>
                            <table-column label="" :sortable="false" :filterable="false">
                                <template slot-scope="user">

                                    <a :href="`/dashboard/admins/${user.id}/edit`" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" style="margin-left: 5px;">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </a>

                                    <a @click="deleteItem(user.id, `/dashboard/admins/${user.id}`, 'userDeleted')" href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                        <i class="fa fa-trash-o fa-lg"></i>
                                    </a>

                                </template>
                            </table-column>
                        </table-component>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </admins-index>
@endsection
