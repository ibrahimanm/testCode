@extends('layouts.app')

@section('content')

    <clients-show inline-template :delegate='{!! isset($delegate) ? $delegate->toJson() : 'null' !!}'>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <h3 class="m-subheader__title m-subheader__title--separator">العملاء</h3>

                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{url('dashboard')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="{{url('dashboard/clients')}}" class="m-nav__link">
                                <span class="m-nav__link-text">العملاء</span>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <span  class="m-nav__link">
                                <span class="m-nav__link-text">@{{ delegate.name }}</span>
                            </span>
                        </li>
                    </ul>

                </div>
                <div>

                     </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="m-portlet m-portlet--full-height  ">
                        <div class="m-portlet__body">
                            <div class="m-card-profile">
                                <div class="m-card-profile__title m--hide">
                                    Your Profile
                                </div>
                                <div class="m-card-profile__pic">
                                    <div class="m-card-profile__pic-wrapper">

                                        <img v-if="delegate.personal_img"  :src="'/storage/'+delegate.personal_img" alt="" />
                                        <img v-else src="/assets/app/media/img/users/user4.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="m-card-profile__details">
                                    <span class="m-card-profile__name" style="color: #ffcc00">
                                        <span style="margin-left: -3px;">
                                            <i v-for="r in Math.round(delegate.rate)"   class="fa fa-star fa-1x"></i>
                                        </span>
                                        <span >
                                        <i v-for="r in 5-Math.round(delegate.rate)" style="margin: 2px ;" class="fa fa-star-o fa-1x"></i>
                                        </span>

                                    </span>

                                    <span class="m-card-profile__name">@{{ delegate.name }}</span>
                                    <a href="" class="m-card-profile__email m-link">@{{ delegate.email }}</a>
                                        <p>
                                            <span v-if="delegate.active" class="m-badge m-badge--success m-badge--wide">مفعل</span>
                                            <span v-else class="m-badge m-badge--danger m-badge--wide ">غير مفعل</span>
                                        </p>

                                </div>
                            </div>

                            <div class="m-portlet__body-separator"></div>
                            <div class="m-widget1 m-widget1--paddingless">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">عدد طلبات التوصيل المكتملة</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.completed_package_orders_count }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">عدد طلبات التوصيل الملغاة</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.canceled_package_orders_count }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">عدد طلبات المشاوير المكتملة</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-warning">@{{ delegate.completed_taxi_orders_count }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">عدد طلبات المشاوير الملغاة</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger">@{{ delegate.canceled_taxi_orders_count }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                            <i class="flaticon-share m--hide"></i>
                                           البيانات الشخصية
                                        </a>
                                    </li>

                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                            طلبات التوصيل
                                        </a>
                                    </li>

                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                            طلبات المشاوير
                                        </a>
                                    </li>

                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_4" role="tab">
                                            الشكاوي
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_5" role="tab">
                                            التعليقات
                                        </a>
                                    </li>

                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_6" role="tab">
                                            الفواتير
                                        </a>
                                    </li>

                                </ul>
                            </div>

                        </div>
                        <div class="tab-content">

                            {{--Personal Info.--}}
                            <div class="tab-pane active" id="m_user_profile_tab_1">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="m-widget13">

                                            {{--Gender--}}
                                            <div class="m-widget13__item">
                                                <br>
                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													الجنس :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                   <span v-if="delegate.gender=='male'" class="m-badge m-badge--primary m-badge--wide">ذكر</span>
                                                   <span v-else class="m-badge m-badge--primary m-badge--wide">أنثى</span>
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--dob--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													 تاريخ الميلاد :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ delegate.dob }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>


                                            {{--City--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													المدينة :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span v-if="delegate.city" class="m-widget13__text m-widget13__text-bolder">
												@{{ delegate.city.name }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </div>

                            </div>


                            {{--Package ORDERS TAB--}}
                            <div class="tab-pane " id="m_user_profile_tab_2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table-component
                                                        :data="fetchPackageOrders"
                                                        :show-caption="false"
                                                        ref="table"
                                                >

                                                    <table-column show="code" label="معرف الطلب ">
                                                        <template slot-scope="order">
                                                            <a :href="'/dashboard/delivery_orders/'+order.id" >@{{ order.code }}</a>

                                                        </template>
                                                    </table-column>
                                                    <table-column  label="المندوب">
                                                        <template slot-scope="user">
                                                            <span v-if="user.delegate" >@{{ user.delegate.name }}</span>
                                                            <span v-else>-</span>
                                                        </template>
                                                    </table-column>
                                                    <table-column  label="جوال المندوب">
                                                        <template slot-scope="user">
                                                            <span v-if="user.delegate" >@{{ user.delegate.mobile }}</span>
                                                            <span v-else>-</span>
                                                        </template>
                                                    </table-column>

                                                    <table-column  label="حالة الطلب">
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

                                                    <table-column  label=" سعر التوصيل">
                                                        <template slot-scope="user">
                                                            <span v-if="user.delivery_price" >@{{ user.delivery_price }}</span>
                                                            <span v-else class="m-badge m-badge--warning m-badge--wide">لم يحدد</span>
                                                        </template>
                                                    </table-column>

                                                </table-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-------------------}}

                            {{--Taxi ORDERS TAB--}}
                            <div class="tab-pane " id="m_user_profile_tab_3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table-component
                                                        :data="fetchTaxiOrders"
                                                        :show-caption="false"
                                                        ref="table"
                                                >

                                                    <table-column show="code" label="معرف الطلب ">
                                                        <template slot-scope="order">
                                                            <a :href="'/dashboard/taxi_orders/'+order.id" >@{{ order.code }}</a>

                                                        </template>
                                                    </table-column>
                                                    <table-column  label="السائق">
                                                        <template slot-scope="user">
                                                            <span v-if="user.driver" >@{{ user.driver.name }}</span>
                                                            <span v-else>-</span>
                                                        </template>
                                                    </table-column>
                                                    <table-column  label="جوال السائق">
                                                        <template slot-scope="user">
                                                            <span v-if="user.driver" >@{{ user.driver.mobile }}</span>
                                                            <span v-else>-</span>
                                                        </template>
                                                    </table-column>

                                                    <table-column  label="حالة الطلب">
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

                                                    <table-column  label=" سعر التوصيل">
                                                        <template slot-scope="user">
                                                            <span v-if="user.delivery_price" >@{{ user.delivery_price }}</span>
                                                            <span v-else class="m-badge m-badge--warning m-badge--wide">لم يحدد</span>
                                                        </template>
                                                    </table-column>

                                                </table-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-------------------}}



                            {{--Complaint--}}
                            <div class="tab-pane " id="m_user_profile_tab_4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table-component
                                                        :data="fetchComplaints"
                                                        :show-caption="false"
                                                        ref="table"
                                                >

                                                    <table-column show="code" label="معرف الطلب ">
                                                        <template slot-scope="user">
                                                            <a v-if="user.user && user.user.type=='driver'" :href="'/dashboard/taxi_orders/'+user.order.id" >@{{ user.order.code}}</a>
                                                            <a v-if="user.user && user.user.type=='delegate'" :href="'/dashboard/delivery_orders/'+user.order.id" >@{{ user.order.code}}</a>

                                                        </template>
                                                    </table-column>
                                                    <table-column  label="المندوب/السائق">
                                                        <template slot-scope="user">
                                                            <a v-if="user.user && user.user.type=='driver'" :href="'/dashboard/drivers/'+user.user.id" >@{{ user.user.name}}</a>
                                                            <a v-if="user.user && user.user.type=='delegate'" :href="'/dashboard/delegates/'+user.user.id" >@{{ user.user.name}}</a>
                                                        </template>
                                                    </table-column>

                                                    <table-column  label="الصفة">
                                                        <template slot-scope="complaint">
                                                            <span v-if="complaint.type"  >@{{ complaint.type }}</span>
                                                            <span v-else>-</span>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label="حالة الطلب">
                                                        <template slot-scope="user">
                                                            <span v-if="user.status == 'new'" class="m-badge m-badge--success m-badge--wide">جديد</span>
                                                            <span v-if="user.status == 'driver_confirm'" class="m-badge m-badge--success m-badge--wide">تأكيد السائق</span>
                                                            <span v-if="user.status == 'driver_waiting'" class="m-badge m-badge--success m-badge--wide">السائق في الانتظار</span>
                                                            <span v-if="user.status == 'in_way'" class="m-badge m-badge--success m-badge--wide">في الطريق</span>
                                                            <span v-if="user.status == 'reception_confirm'" class="m-badge m-badge--success m-badge--wide">تأكيد التوصيل</span>
                                                            <span v-if="user.status == 'canceled'" class="m-badge m-badge--success m-badge--wide">ملغي</span>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label="سبب الشكوى">
                                                        <template slot-scope="complaint">
                                                            <span v-if="complaint.reason"  >@{{ complaint.reason.name }}</span>
                                                            <span v-else>-</span>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label=" نص الشكوى">
                                                        <template slot-scope="complaint">
                                                            <span  >@{{ complaint.text }}</span>

                                                        </template>
                                                    </table-column>

                                                </table-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--Comments--}}
                            <div class="tab-pane " id="m_user_profile_tab_5">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table-component
                                                        :data="fetchComments"
                                                        :show-caption="false"
                                                        ref="table"
                                                >

                                                    <table-column  label="اسم المندوب/السائق">
                                                        <template slot-scope="rate">
                                                            <a v-if="rate.user_from && rate.user_from.type=='driver'" :href="'/dashboard/drivers/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>
                                                            <a v-if="rate.user_from && rate.user_from.type=='delegate'" :href="'/dashboard/delegates/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label="معرف الطلب">
                                                        <template slot-scope="rate">
                                                            <a v-if="rate.user_from && rate.user_from.type=='driver'" :href="'/dashboard/taxi_orders/'+rate.order.id" >@{{ rate.order.code}}</a>
                                                            <a v-if="rate.user_from && rate.user_from.type=='delegate'" :href="'/dashboard/delivery_orders/'+rate.order.id" >@{{ rate.order.code}}</a>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label="التعليق">
                                                        <template slot-scope="user">
                                                            <span  >@{{ user.comment }}</span>
                                                        </template>
                                                    </table-column>

                                                    <table-column  label=" التقييم">
                                                        <template slot-scope="rate">

                                                          <span style="margin-left: -3px;color: #ffcc00;">
                                                            <i v-for="r in Math.round(rate.rate)"   class="fa fa-star fa-2x"></i>
                                                        </span>
                                                                            <span >
                                                        <i v-for="r in 5-Math.round(rate.rate)" style="color: #ffcc00;margin: 2px ;" class="fa fa-star-o fa-2x"></i>
                                                        </span>

                                                        </template>
                                                    </table-column>

                                                </table-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--الفواتير--}}
                            <div class="tab-pane " id="m_user_profile_tab_6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table-component
                                                        :data="fetchComments"
                                                        :show-caption="false"
                                                        ref="table"
                                                >

                                                    <table-column  label="اسم المندوب/السائق">
                                                        <template slot-scope="rate">
                                                            <a v-if="rate.user_from && rate.user_from.type=='driver'" :href="'/dashboard/drivers/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>
                                                            <a v-if="rate.user_from && rate.user_from.type=='delegate'" :href="'/dashboard/delegates/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label="معرف الطلب">
                                                        <template slot-scope="rate">
                                                            <a v-if="rate.user_from && rate.user_from.type=='driver'" :href="'/dashboard/taxi_orders/'+rate.order.id" >@{{ rate.order.code}}</a>
                                                            <a v-if="rate.user_from && rate.user_from.type=='delegate'" :href="'/dashboard/delivery_orders/'+rate.order.id" >@{{ rate.order.code}}</a>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label="التعليق">
                                                        <template slot-scope="user">
                                                            <span  >@{{ user.comment }}</span>
                                                        </template>
                                                    </table-column>

                                                    <table-column  label=" التقييم">
                                                        <template slot-scope="rate">

                                                          <span style="margin-left: -3px;color: #ffcc00;">
                                                            <i v-for="r in Math.round(rate.rate)"   class="fa fa-star fa-2x"></i>
                                                        </span>
                                                            <span >
                                                        <i v-for="r in 5-Math.round(rate.rate)" style="color: #ffcc00;margin: 2px ;" class="fa fa-star-o fa-2x"></i>
                                                        </span>

                                                        </template>
                                                    </table-column>

                                                </table-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    {{--Image Preview Modal --}}
    <!-- Modal -->
        <div class="modal fade " id="image_modal"  tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">صورة</h5>
                        <button type="button" class="close" @click="closeImageModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img  :src="'/storage/'+modalImage"  :alt="modalImage" class="img-thumbnail">

                    </div>
                    <div class="modal-footer">

                       </div>
                </div>
            </div>
        </div>


    </div>
    </clients-show>
@endsection