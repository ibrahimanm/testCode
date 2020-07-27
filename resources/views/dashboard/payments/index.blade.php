@extends('layouts.app')

@section('content')
    <payments-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">الدفعات المالية</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">

                    <a href="/dashboard/payments/create" class="btn btn-primary">اضافة دفعة</a>

                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                        <table-component
                                :data="fetchData"
                                :show-caption="false"
                                {{--sort-by="created_at"--}}
                                sort-order="desc"
                                ref="table"
                        >
                            <table-column  :sortable="true" show="value"  label="المبلغ">
                                <template slot-scope="payment">
                                    <span v-if="payment.type=='from_admin'" class="m--font-danger">-@{{ payment.value }} <span>ريال</span></span>
                                    <span v-if="payment.type=='to_admin'" class="m--font-success">+@{{ payment.value }} <span>ريال</span></span>

                                </template>
                            </table-column>

                            <table-column :sortable="false"  label="العملية">
                                <template slot-scope="payment">
                                    <span v-if="payment.type=='from_admin'" >دفعة للمندوب/السائق</span>
                                    <span v-if="payment.type=='to_admin'" >دفعة للنظام</span>
                                </template>
                            </table-column>

                            <table-column :sortable="false"  label="المدير">
                                <template slot-scope="payment">
                                    <a v-if="payment.admin" :href="'/dashboard/admins/'+payment.admin.id" >@{{ payment.admin.name }}</a>
                                    <span v-else>-</span>
                                </template>
                            </table-column>

                            <table-column :sortable="false"  label="المندوب / السائق">
                                <template slot-scope="payment">
                                    <a v-if="payment.user && payment.user.type=='delegate'" :href="'/dashboard/delegates/'+payment.user.id" >@{{ payment.user.name }}</a>

                                    <a v-if="payment.user && payment.user.type=='driver'" :href="'/dashboard/drivers/'+payment.user.id" >@{{ payment.user.name }}</a>

                                </template>
                            </table-column>


                            <table-column :sortable="true" show="created_at" label="التاريخ">
                                <template slot-scope="payment">
                                    <span >@{{ payment.created_at| moment }}</span>
                                </template>
                            </table-column>

                            <table-column :sortable="false" label="طريقة الدفع">
                                <template slot-scope="payment">
                                    <span v-if="payment.payment_method=='cash'" >كاش</span>
                                    <span v-if="payment.payment_method=='visa'" >فيزا</span>
                                    <span v-if="payment.payment_method=='bank_transfer'" >حوالة بنكية</span>
                                </template>
                            </table-column>

                            <table-column :sortable="false" label="صورة الايداع">
                                <template slot-scope="payment">
                                    <span v-if="payment.file"><a  :href="'/'+payment.file"><i class="fa fa-file-alt"></i></a></span>
                                    <span v-else>-</span>

                                </template>
                            </table-column>

                            <table-column label=" حالة الدفعة">
                                <template slot-scope="payment">
                                    <button v-if="payment.status == 'new'"  @click="confirm(payment.id)" class="m-badge m-badge--warning m-badge--wide">تأكيد</button>
                                    <span v-else class="m-badge m-badge--success m-badge--wide">مؤكد</span>
                                </template>
                            </table-column>
                        </table-component>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </payments-index>
@endsection
