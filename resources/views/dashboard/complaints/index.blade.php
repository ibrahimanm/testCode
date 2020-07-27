@extends('layouts.app')

@section('content')
    <complaints-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">الشكاوى</h3>
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
                                <template slot-scope="complaint">
                                    <span v-if="complaint.user" >@{{ complaint.user.name }}</span>
                                    <span v-else >-</span>
                                </template>
                            </table-column>
                            <table-column  label="الصفة">
                                <template slot-scope="user">
                                    <span class="m-badge m-badge--success m-badge--wide">@{{ user.type }}</span>
                                </template>
                            </table-column>
                            <table-column  label="رقم الطلب">
                                <template slot-scope="complaint">
                                    <span v-if="complaint.order" >@{{ complaint.order.code }}</span>
                                    <span v-else >-</span>
                                </template>
                            </table-column>
                            <table-column  label="رقم الجوال">
                                <template slot-scope="complaint">
                                    <span v-if="complaint.user" >@{{ complaint.user.mobile }}</span>
                                    <span v-else >-</span>
                                </template>
                            </table-column>

                            <table-column  label=" حالة الشكوى">
                                <template slot-scope="complaint">
                                    <span v-if="complaint.status == 'new'" class="m-badge m-badge--success m-badge--wide">جديدة</span>
                                    <button  v-else-if="complaint.status == 'open'" class="m-badge m-badge--warning m-badge--wide">مفتوحة</button>
                                    <button  v-else class="m-badge m-badge--danger m-badge--wide">مغلقة</button>
                                </template>
                            </table-column>

                            <table-column  label=" رد المندوب">
                                <template slot-scope="complaint">
                                    <span v-if="complaint.reply "><i @click="openReplayModal(complaint.reply)" class="fa fa-reply text-center"></i></span>
                                    <span v-else >-</span>
                                </template>
                            </table-column>

                            <table-column label="" :sortable="false" :filterable="false">
                                <template slot-scope="user">

                                    {{--<button v-if="user.status =='new'" @click="openCloseComplaint(user.id,'open')"  href="javascript:;" class="btn btn-outline-success ">--}}
                                       {{--فتح--}}
                                    {{--</button>--}}

                                    {{--<button v-if="user.status =='new' || user.status=='open'" @click="openCloseComplaint(user.id,'closed')"  href="javascript:;" class="btn btn-outline-danger ">--}}
                                        {{--اغلاق--}}
                                    {{--</button>--}}

                                    <a :href="'/dashboard/complaints/'+user.id" class="btn btn-outline-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
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
            <div class="modal fade" id="replay_modal"  tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">رد المندوب</h5>
                            <button type="button" class="close" @click="closeReplayModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <p>@{{ reply }}</p>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </complaints-index>

@endsection
