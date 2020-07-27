@extends('layouts.app')

@section('content')

    <drivers-show inline-template :delegate='{!! isset($delegate) ? $delegate->toJson() : 'null' !!}'>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <h3 class="m-subheader__title m-subheader__title--separator">السائقين</h3>

                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{url('dashboard')}}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="{{url('dashboard/drivers')}}" class="m-nav__link">
                                <span class="m-nav__link-text">السائقين</span>
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

                                        <img v-if="delegate.personal_img"  :src="'https://taxi-api.applaab.com/'+delegate.personal_img" alt="" />
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
                                            <h3 class="m-widget1__title">الرصيدالحالي</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.budget }} {{CURRENCY}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">اجمالي الدخل</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.total_income }} {{CURRENCY}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">الأرباح من السائق</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.net_profit }} {{CURRENCY}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">ما تم دفعه للنظام</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.paied_to_system }} {{CURRENCY}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">متبقي للنظام</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.remain_to_system }} {{CURRENCY}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">متبقي للسائق</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.remain_to_driver }} {{CURRENCY}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">عدد الطلبات المكتملة</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success">@{{ delegate.completed_orders_count }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">عدد الطلبات الجارية</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-warning">@{{ delegate.pending_orders_count }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">عدد الطلبات الملغاة</h3>
                                            <span class="m-widget1__desc"></span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger">@{{ delegate.canceled_orders_count }}</span>
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
                                            الطلبات
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                            الدفعات
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

                                            {{--Social Status--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													 الحالة الاجتماعية  :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                 <span v-if="delegate.social_status=='single'" class="m-badge m-badge--info m-badge--wide">أعزب</span>
                                                   <span v-else class="m-badge m-badge--info m-badge--wide">متزوج</span>
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--Sicantific degree--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													 الدرجة العلمية  :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ delegate.scientific_degree }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--Confirmation date --}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													تاريخ التوثيق :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                           <span v-if="delegate.confirmation_date">@{{ delegate.confirmation_date }}</span>
                                                           <span v-else>-</span>
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

                                            {{--bank_name--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													البنك :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span v-if="delegate.bank" class="m-widget13__text m-widget13__text-bolder">
												        @{{ delegate.bank.name }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--bank_no--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													رقم الآيبان :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
												@{{ delegate.bank_account_no }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--National ID--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													رقم الهوية :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ delegate.nationality_id }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--ID image--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													صورة الهوية الشخصية :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													{{--@{{ delegate.id_img }}--}}
                                                           <img v-if="delegate.id_img" style="max-height: 100px;cursor: pointer;" :src="'https://taxi-api.applaab.com/'+delegate.id_img" @click="openImageModal(delegate.id_img)" :alt="delegate.id_img" class="img-thumbnail">
												       <span v-else>-</span>
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--Licence image--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													صورة رخصة القيادة :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">

                                                        <img v-if="delegate.car_licence_img" style="max-height: 100px; cursor: pointer" :src="'https://taxi-api.applaab.com/'+delegate.car_licence_img" @click="openImageModal(delegate.car_licence_img)" alt="..." class="img-thumbnail">
                                                            <span v-else>-</span>

												        </span>
                                                    </div>
                                                </div>

                                            </div>


                                            {{--Vichel Type--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													نوع المركبة :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">

                                                          <span v-if="delegate.vehicle_type=='car'" class="m-badge m-badge--info m-badge--wide">
                                                              سيارة
                                                              &nbsp;
                                                          <i class="fa fa-car"></i>
                                                          </span>
                                                           <span v-if="delegate.vehicle_type=='bicycle'" class="m-badge m-badge--info m-badge--wide">
                                                              دراجة هوائية
                                                              &nbsp;
                                                          <i class="fa fa-bicycle"></i>
                                                          </span>
                                                           <span v-if="delegate.vehicle_type=='motorcycle'" class="m-badge m-badge--info m-badge--wide">
                                                              دراجة نارية
                                                              &nbsp;
                                                          <i class="fa fa-motorcycle"></i>
                                                          </span>
                                                           <span v-if="delegate.vehicle_type=='van'" class="m-badge m-badge--info m-badge--wide">
                                                              شاحنة
                                                              &nbsp;
                                                          <i class="fa fa-truck"></i>
                                                          </span>



												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--Type image--}}
{{--                                            <div class="m-widget13__item">--}}

{{--                                                <div class="row">--}}
{{--                                                    <div class="col-3">--}}
{{--                                                       <span class="m-widget13__desc m--align-right">--}}
{{--													صورة نوع السيارة :--}}
{{--												</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-9">--}}
{{--                                                       <span class="m-widget13__text m-widget13__text-bolder">--}}

{{--                                                        <img v-if="delegate.vehicle_type_img" style="max-height: 100px; cursor: pointer" :src="'/storage/'+delegate.vehicle_type_img" @click="openImageModal(delegate.vehicle_type_img)" alt="..." class="img-thumbnail">--}}
{{--                                                            <span v-else>-</span>--}}

{{--												        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
                                            {{--car company--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													شركة المركبة :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ delegate.company.name }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>
                                            {{--car style--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
                                                           طراز المركبة :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ delegate.style.name }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--car model--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													موديل المركبة :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ delegate.model.name }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--Passenger no--}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													عدد الركاب :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ delegate.number_of_passengers }}
												        </span>
                                                    </div>
                                                </div>

                                            </div>



                                            {{--Languages --}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													اللغات التي يتكلمها :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                           <span v-if="delegate.speak_languages">
                                                               <span  v-for="(lan ,index) in delegate.lang_array">@{{ __(lan) }}
                                                               <span v-if="index != delegate.lang_array.length-1">&nbsp; , &nbsp;</span>
                                                               </span>
                                                           </span>
                                                           <span v-else>-</span>

												        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            {{--vihcle images --}}
                                            <div class="m-widget13__item">

                                                <div class="row">
                                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													صور المركبة :
												</span>
                                                    </div>
                                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													{{--@{{ delegate.vehicle_type }}--}}
                                                           <span v-if="delegate.vehicle_images">
                                                         <img v-for="img in delegate.vehicle_images_array "  style="max-height: 100px; cursor: pointer" :src="'https://taxi-api.applaab.com/'+img" @click="openImageModal(img)" alt="..." class="img-thumbnail">
                                                           </span>
                                                           <span v-else>-</span>

												        </span>
                                                    </div>
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </div>

                            </div>


                            {{--ORDERS TAB--}}
                            <div class="tab-pane " id="m_user_profile_tab_2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table-component
                                                        :data="fetchData"
                                                        :show-caption="false"
                                                        ref="table"
                                                >

                                                    <table-column show="code" label="معرف الطلب ">
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
                                                            <span v-if="user.client" >@{{ user.client.mobile }}</span>
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

                            {{--Payments--}}
                            <div class="tab-pane " id="m_user_profile_tab_3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <div class="m-section">

                                            <div class="m-section__content">
                                                <table-component
                                                        :data="fetchPayments"
                                                        :show-caption="false"
                                                        ref="table"
                                                >
                                                    <table-column  label="المبلغ">
                                                        <template slot-scope="payment">
                                                            <span v-if="payment.type=='from_admin'" class="m--font-danger">-@{{ payment.value }} <span>ريال</span></span>
                                                            <span v-if="payment.type=='to_admin'" class="m--font-success">+@{{ payment.value }} <span>ريال</span></span>


                                                        </template>
                                                    </table-column>

                                                    <table-column show="code" label="المدير">
                                                        <template slot-scope="payment">
                                                            <a :href="'/dashboard/admins/'+payment.admin.id" >@{{ payment.admin.name }}</a>

                                                        </template>
                                                    </table-column>


                                                    <table-column  label="التاريخ">
                                                        <template slot-scope="payment">
                                                            <span >@{{ payment.created_at| moment }}</span>
                                                        </template>
                                                    </table-column>

                                                    <table-column  label="طريقة الدفع">
                                                        <template slot-scope="payment">
                                                            <span v-if="payment.payment_method=='cash'" >كاش</span>
                                                            <span v-if="payment.payment_method=='visa'" >فيزا</span>
                                                            <span v-if="payment.payment_method=='bank_transfer'" >حوالة بنكية</span>
                                                        </template>
                                                    </table-column>

                                                    <table-column  label="صورة الايداع">
                                                        <template slot-scope="payment">
                                                            <span v-if="payment.file"><a  :href="'/'+payment.file"><i class="fa fa-file-alt"></i></a></span>
                                                            <span v-else>-</span>

                                                        </template>
                                                    </table-column>

                                                </table-component>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                                        <template slot-scope="order">
                                                            <a :href="'/dashboard/delivery_orders/'+order.order.id" >@{{ order.order.code }}</a>

                                                        </template>
                                                    </table-column>
                                                    <table-column  label="العميل">
                                                        <template slot-scope="user">
                                                            <span v-if="user.user" >@{{ user.user.name }}</span>
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

                                                    <table-column  label="اسم العميل">
                                                        <template slot-scope="rate">
                                                            <a :href="'/dashboard/clients/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>

                                                        </template>
                                                    </table-column>

                                                    <table-column  label="معرف الطلب">
                                                        <template slot-scope="rate">
                                                            <a :href="'/dashboard/clients/'+rate.order.id" >@{{ rate.order.code}}</a>

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
    </drivers-show>
@endsection
