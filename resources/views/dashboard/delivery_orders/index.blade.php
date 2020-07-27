@extends('layouts.app')

@section('content')
    <delivery-orders-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">طلبات التوصيل</h3>
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
                                    <a :href="'/dashboard/delivery_orders/'+order.id" >@{{ order.code }}</a>

                                </template>
                            </table-column>

                            <table-column show="name" label="العميل ">
                                <template slot-scope="client">
                                    <a :href="'/dashboard/clients/'+client.client.id" >@{{ client.client.name }}</a>

                                </template>
                            </table-column>
                            <table-column  label="جوال العميل">
                                <template slot-scope="user">
                                    <span v-if="user.client.mobile" >@{{ user.client.mobile }}</span>
                                    <span v-else>-</span>
                                </template>
                            </table-column>
                            <table-column  label="المندوب">
                                <template slot-scope="user">
                                    <span v-if="user.delegate" >
                                     <a :href="'/dashboard/delegates/'+user.delegate.id" >@{{ user.delegate.name }}</a>
                                    </span>
                                    <span v-else>-</span>
                                </template>
                            </table-column>
                            <table-column  label="حالة الطلب">
                                <template slot-scope="user">
                                    <span v-if="user.status == 'new'" class="m-badge m-badge--success m-badge--wide">جديد</span>
                                    <span v-if="user.status == 'confirmed'" class="m-badge m-badge--success m-badge--wide">الطلبية مؤكدة</span>
                                    <span v-if="user.status == 'in_way'" class="m-badge m-badge--success m-badge--wide">في الطريق</span>
                                    <span v-if="user.status == 'arrive_to_store'" class="m-badge m-badge--success m-badge--wide">الوصول للمتجر</span>
                                    <span v-if="user.status == 'ask_order_store'" class="m-badge m-badge--success m-badge--wide">طلب الطرد من المتجر</span>
                                    <span v-if="user.status == 'receive_order_store'" class="m-badge m-badge--success m-badge--wide">تم استلام الطرد</span>
                                    <span v-if="user.status == 'arrive_to_client_location'" class="m-badge m-badge--success m-badge--wide">وصل المندوب لموقع العميل</span>
                                    <span v-if="user.status == 'delivery_confirmed'" class="m-badge m-badge--success m-badge--wide">تأكيد التسليم</span>
                                    <span v-if="user.status == 'reception_confirmed'" class="m-badge m-badge--success m-badge--wide">تأكيد الاستلام</span>
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

                                    <a :href="'/dashboard/delivery_orders/'+order.id" class="btn btn-outline-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
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
    </delivery-orders-index>
@endsection
