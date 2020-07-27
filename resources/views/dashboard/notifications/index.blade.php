@extends('layouts.app')

@section('content')
    <notifications-index inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">الاشعارات</h3>
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
                                    <span v-if="complaint.user_to" >@{{ complaint.user_to.name }}</span>
                                    <span v-else >-</span>
                                </template>
                            </table-column>
                            <table-column  label="الصفة">
                                <template slot-scope="user">
                                    <span class="m-badge m-badge--success m-badge--wide">@{{ user.type }}</span>
                                </template>
                            </table-column>

                            <table-column  label="رقم الجوال">
                                <template slot-scope="notification">
                                    <span v-if="notification.user_to" >@{{ notification.user_to.mobile }}</span>
                                    <span v-else >-</span>
                                </template>
                            </table-column>



                            <table-column label="" :sortable="false" :filterable="false">
                                <template slot-scope="user">


                                    <a  href="javascript:;" class="btn btn-outline-info ">
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
    </notifications-index>
@endsection
