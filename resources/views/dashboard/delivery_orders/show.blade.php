@extends('layouts.app')

@section('content')

    <delivery-orders-show inline-template :order='{!! isset($order) ? $order->toJson() : 'null' !!}'>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <h3 class="m-subheader__title m-subheader__title--separator">طلبات التوصيل</h3>

                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="{{url('dashboard')}}" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                                <a href="{{url('dashboard/delivery_orders')}}" class="m-nav__link">
                                    <span class="m-nav__link-text">طلبات التوصيل</span>
                                </a>
                            </li>
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                            <span  class="m-nav__link">
                                <span class="m-nav__link-text">@{{ order.code }}</span>
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

                                {{--client--}}
                                <div class="m-card-profile">
                                    <div class="m-card-profile__title ">
                                        بيانات العميل
                                    </div>
                                    <div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">

                                            <img v-if="order.client.personal_img"  :src="'/storage/'+order.client.personal_img" alt="" />
                                            <img v-else src="/assets/app/media/img/users/user4.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                    <span class="m-card-profile__name" style="color: #ffcc00">
                                        <span style="margin-left: -3px;">
                                            <i v-for="r in Math.round(order.client.rate)"   class="fa fa-star fa-1x"></i>
                                        </span>
                                        <span >
                                        <i v-for="r in 5-Math.round(order.client.rate)" style="margin: 2px ;" class="fa fa-star-o fa-1x"></i>
                                        </span>

                                    </span>

                                        <span class="m-card-profile__name">@{{ order.client.name }}</span>
                                        <a href="" class="m-card-profile__email m-link">@{{ order.client.email }}</a>
                                        <p>
                                            <span v-if="order.client.active" class="m-badge m-badge--success m-badge--wide">مفعل</span>
                                            <span v-else class="m-badge m-badge--danger m-badge--wide ">غير مفعل</span>
                                        </p>

                                    </div>
                                </div>

                                <div class="m-portlet__body-separator"></div>

                                {{--Delegate--}}
                                <div v-if="order.delegate"  class="m-card-profile">
                                    <div class="m-card-profile__title ">
                                        بيانات المندوب
                                    </div>
                                    <div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">

                                            <img v-if="order.delegate.personal_img"  :src="'/storage/'+order.delegate.personal_img" alt="" />
                                            <img v-else src="/assets/app/media/img/users/user4.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                    <span class="m-card-profile__name" style="color: #ffcc00">
                                        <span style="margin-left: -3px;">
                                            <i v-for="r in Math.round(order.delegate.rate)"   class="fa fa-star fa-1x"></i>
                                        </span>
                                        <span >
                                        <i v-for="r in 5-Math.round(order.delegate.rate)" style="margin: 2px ;" class="fa fa-star-o fa-1x"></i>
                                        </span>

                                    </span>

                                        <span class="m-card-profile__name">@{{ order.delegate.name }}</span>
                                        <a href="" class="m-card-profile__email m-link">@{{ order.delegate.email }}</a>
                                        <p>
                                            <span v-if="order.delegate.active" class="m-badge m-badge--success m-badge--wide">مفعل</span>
                                            <span v-else class="m-badge m-badge--danger m-badge--wide ">غير مفعل</span>
                                        </p>

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
                                                بيانات الطلبية
                                            </a>
                                        </li>

                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                                الشكاوي
                                            </a>
                                        </li>

                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                               التقييمات
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

                                                {{--Status--}}
                                                <div class="m-widget13__item">
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													حالة الطلب :
												</span>
                                                        </div>
                                                        <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                            <span v-if="order.status == 'new'" class="m-badge m-badge--success m-badge--wide">جديد</span>
                                                            <span v-if="order.status == 'confirmed'" class="m-badge m-badge--success m-badge--wide">الطلبية مؤكدة</span>
                                                            <span v-if="order.status == 'in_way'" class="m-badge m-badge--success m-badge--wide">في الطريق</span>
                                                            <span v-if="order.status == 'arrive_to_store'" class="m-badge m-badge--success m-badge--wide">الوصول للمتجر</span>
                                                            <span v-if="order.status == 'ask_order_store'" class="m-badge m-badge--success m-badge--wide">طلب الطرد من المتجر</span>
                                                            <span v-if="order.status == 'receive_order_store'" class="m-badge m-badge--success m-badge--wide">تم استلام الطرد</span>
                                                            <span v-if="order.status == 'arrive_to_client_location'" class="m-badge m-badge--success m-badge--wide">وصل المندوب لموقع العميل</span>
                                                            <span v-if="order.status == 'delivery_confirmed'" class="m-badge m-badge--success m-badge--wide">تأكيد التسليم</span>
                                                            <span v-if="order.status == 'reception_confirmed'" class="m-badge m-badge--success m-badge--wide">تأكيد الاستلام</span>
                                                            <span v-if="order.status == 'canceled'" class="m-badge m-badge--success m-badge--wide">ملغي</span>
												        </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                {{--type--}}
                                                <div class="m-widget13__item">

                                                    <div class="row">
                                                        <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													 نوع الطلب :
												</span>
                                                        </div>
                                                        <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													<span v-if="order.type=='package'">طلب توصيل</span>
													<span v-if="order.type=='store'">طلب من متجر</span>
												        </span>
                                                        </div>
                                                    </div>

                                                </div>


                                                {{--date--}}
                                                <div class="m-widget13__item">

                                                    <div class="row">
                                                        <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													تاريخ الطلب :
												</span>
                                                        </div>
                                                        <div class="col-9">
                                                       <span  class="m-widget13__text m-widget13__text-bolder">
												@{{ order.created_at}}
												        </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                {{--package images --}}
                                                <div class="m-widget13__item">

                                                    <div class="row">
                                                        <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													صور الطرد :
												</span>
                                                        </div>
                                                        <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                           <span v-if="order.images">
                                                         <img v-for="img in order.package_images_array "  style="max-height: 100px; cursor: pointer" :src="'/storage/'+img" @click="openImageModal(img)" alt="..." class="img-thumbnail">
                                                           </span>
                                                           <span v-else>-</span>

												        </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                {{--confirmation date--}}
                                                <div class="m-widget13__item">

                                                    <div class="row">
                                                        <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													تاريخ تأكيد الطلب :
												</span>
                                                        </div>
                                                        <div class="col-9">
                                                       <span v-if="order.confirmed_at"  class="m-widget13__text m-widget13__text-bolder">
												@{{ order.confirmed_at }}
												        </span>
                                                            <span v-else class="m-badge m-badge--warning m-badge--wide">لم يحدد</span>
                                                        </div>
                                                    </div>

                                                </div>

                                                {{--delivery price--}}
                                                <div class="m-widget13__item">

                                                    <div class="row">
                                                        <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													سعر التوصيل :
												</span>
                                                        </div>
                                                        <div class="col-9">
                                                       <span v-if="order.delivery_price"  class="m-widget13__text m-widget13__text-bolder">
												@{{ order.delivery_price }}
												        </span>
                                                            <span v-else class="m-badge m-badge--warning m-badge--wide">لم يحدد</span>
                                                        </div>
                                                    </div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>

                                    {{--map--}}
                                    <br>
                                    <div class="row">
                                        <gmap-map
                                                ref="myMap"
                                                :center="{lat: parseFloat(order.source_lat), lng:parseFloat(order.source_long)}"
                                                :zoom="10"
                                                map-type-id="roadmap"
                                                style="width: 100%; height: 400px"
                                        >
                                        </gmap-map>
                                    </div>
                                    {{--map--}}

                                </div>


                                {{--Complaint--}}
                                <div class="tab-pane " id="m_user_profile_tab_2">
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

                                                        <table-column  label="الاسم">
                                                            <template slot-scope="user">
                                                                <a v-if="user.user && user.user.type=='driver'" :href="'/dashboard/drivers/'+user.user.id" >@{{ user.user.name}}</a>
                                                                <a v-if="user.user && user.user.type=='delegate'" :href="'/dashboard/delegates/'+user.user.id" >@{{ user.user.name}}</a>
                                                                <a v-else :href="'/dashboard/clients/'+user.user.id" >@{{ user.user.name}}</a>
                                                            </template>
                                                        </table-column>

                                                        <table-column  label="الصفة">
                                                            <template slot-scope="complaint">
                                                                <span v-if="complaint.type" class="m-badge m-badge--success m-badge--wide"  >@{{ complaint.type }}</span>
                                                                <span v-else>-</span>

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
                                <div class="tab-pane " id="m_user_profile_tab_3">
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

                                                        <table-column  label="الاسم">
                                                            <template slot-scope="rate">
                                                                <a v-if="rate.user_from && rate.rate_user_type=='driver'" :href="'/dashboard/drivers/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>
                                                                <a v-if="rate.user_from && rate.rate_user_type=='delegate'" :href="'/dashboard/delegates/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>
                                                                <a v-if="rate.user_from && rate.rate_user_type=='client'" :href="'/dashboard/clients/'+rate.user_from.id" >@{{ rate.user_from.name}}</a>

                                                            </template>
                                                        </table-column>

                                                        <table-column  label="الصفة">
                                                            <template slot-scope="rate">
                                                                <span v-if="rate.rate_user_type=='delegate'" class="m-badge m-badge--success m-badge--wide">مندوب</span>
                                                                <span v-if="rate.rate_user_type=='driver'" class="m-badge m-badge--success m-badge--wide">سائق</span>
                                                                <span v-if="rate.rate_user_type=='client'" class="m-badge m-badge--success m-badge--wide">عميل</span>
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

                            <br>
                            <div class="tab-content">

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
    </delivery-orders-show>
@endsection