@extends('layouts.app')

@section('content')
    <confirmation_requests-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">طلبات التوثيق</h3>
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
                            <table-column  label="الاسم">
                                <template slot-scope="user">
                                    <span >@{{ user.user.name }}</span>
                                </template>
                            </table-column>
                            <table-column  label="رقم الجوال">
                                <template slot-scope="user">
                                    <span >@{{ user.user.mobile }}</span>
                                </template>
                            </table-column>
                            <table-column  label="البريد الالكتروني">
                                <template slot-scope="user">
                                    <span >@{{ user.user.email }}</span>
                                </template>
                            </table-column>
                            <table-column  label="النوع">
                                <template slot-scope="user">
                                    <span v-if="user.user.type == 'driver'" >سائق</span>
                                    <span v-else >مندوب توصيل</span>
                                </template>
                            </table-column>

                            <table-column  label="الجنس">
                                <template slot-scope="user">
                                    <span v-if="user.user.gender == 'male'" >ذكر</span>
                                    <span v-else >أنثى</span>
                                </template>
                            </table-column>
                            <table-column  label="الحالة">
                                <template slot-scope="user">
                                    <span v-if="user.status == 'new'" class="m-badge m-badge--warning m-badge--wide">جديد</span>
                                    <span v-else-if="user.status == 'accepted'" class="m-badge m-badge--success m-badge--wide">مؤكد</span>
                                    <span v-else class="m-badge m-badge--danger m-badge--wide">غير موثق</span>
                                </template>
                            </table-column>


                            <table-column label="" :sortable="false" :filterable="false">
                                <template slot-scope="user">

                                    <button @click="acceptRejectRequest(user.id,'accepted')"  v-if="user.status == 'new'"  class="btn btn-outline-success m-btn ">
                                       موافقة
                                    </button>

                                    <button @click="acceptRejectRequest(user.id,'rejected')" v-if="user.status == 'new'"   class="btn btn-outline-danger m-btn ">
                                        رفض
                                    </button>

                                    <a  :href="'/dashboard/confirmation_requests/'+user.id" class="btn btn-outline-info m-btn ">
                                        تفاصيل
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
    </confirmation_requests-index>
@endsection
