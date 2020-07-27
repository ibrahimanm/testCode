@extends('layouts.app')

@section('content')
    <taxi-orders-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">طلبات المشاوير</h3>
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

                            <table-column show="name" label="معرف الطلب ">
                                <template slot-scope="order">
                                    <a :href="'/dashboard/taxi_orders/'+order.id" >@{{ order.code }}</a>

                                </template>
                            </table-column>
                        <table-column  label="العميل">
                                <template slot-scope="user">
                                    <span v-if="user.client" >@{{ user.client.name }}</span>
                                    <span v-else>-</span>
                                </template>
                            </table-column>
                            <table-column  label="جوال العميل">
                                <template slot-scope="user">
                                    <span v-if="user.client.mobile" >@{{ user.client.mobile }}</span>
                                   <span v-else>-</span>
                                </template>
                            </table-column>
                            <table-column  label="السائق">
                                <template slot-scope="user">
                                    <span v-if="user.driver" >@{{ user.driver.name }}</span>
                                    <span v-else>-</span>
                                </template>
                            </table-column>
                            <table-column show="active" label="حالة الطلب">
                                <template slot-scope="user">
                                    <span v-if="user.status == 'new'" class="m-badge m-badge--success m-badge--wide">جديد</span>
                                    <span v-if="user.status == 'driver_confirm'" class="m-badge m-badge--success m-badge--wide">تأكيد السائق</span>
                                    <span v-if="user.status == 'driver_waiting'" class="m-badge m-badge--success m-badge--wide">السائق في الانتظار</span>
                                    <span v-if="user.status == 'in_way'" class="m-badge m-badge--success m-badge--wide">في الطريق</span>
                                    <span v-if="user.status == 'reception_confirm'" class="m-badge m-badge--success m-badge--wide">تأكيد التوصيل</span>
                                    <span v-if="user.status == 'canceled'" class="m-badge m-badge--success m-badge--wide">ملغي</span>

                                </template>
                            </table-column>
                            <table-column  label="تاريخ الطلب ">
                                <template slot-scope="user">
                                    <span >@{{ user.created_at }}</span>

                                </template>
                            </table-column>

                            <table-column label="" :sortable="false" :filterable="false">
                                <template slot-scope="order">

                                    <a :href="'/dashboard/taxi_orders/'+order.id" class="btn btn-outline-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                        <i class="fa fa-file-alt fa-lg"></i>
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
    </taxi-orders-index>
@endsection
