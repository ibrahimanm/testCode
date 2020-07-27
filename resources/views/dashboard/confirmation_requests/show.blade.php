@extends('layouts.app')

@section('content')

    <confirmation_req-show inline-template :req='{!! isset($req) ? $req->toJson() : 'null' !!}'>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <h3 class="m-subheader__title m-subheader__title--separator">طلبات التأكيد</h3>

                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="{{url('dashboard')}}" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                                <a href="{{url('dashboard/confirmation_requests')}}" class="m-nav__link">
                                    <span class="m-nav__link-text">طلب تأكيد</span>
                                </a>
                            </li>
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                            <span class="m-nav__link">
                                <span class="m-nav__link-text">@{{ req.user.name }}</span>
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
                    <div class="col-12">
                        <div class="m-widget13">

{{--                            Confirmation date --}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                     <h6 >تاريخ التوثيق :</h6>
                                    </div>
                                    <div class="col-9">
                                    <span class="m-widget13__text m-widget13__text-bolder">
                                        <span v-if="req.user.confirmation_date">@{{ req.user.confirmation_date }}</span>
                                        <span v-else>-</span>
									 </span>
                                    </div>
                                </div>

                            </div>

{{--                            mobile--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                        <h6 >رقم الجوال :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.mobile }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            name--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                   <h6>الاسم :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.name }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            National ID--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                   <h6>رقم الهوية:</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.nationality_id }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            bank_name--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                        <h6>البنك:</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.bank.name }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            bank_no--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                        <h6>رقم الآيبان:</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.bank_account_no }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            email--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                      <h6>البريد الالكتروني :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.email }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            dob--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                     <h6>تاريخ الميلاد :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.dob }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            Gender--}}
                            <div class="m-widget13__item">
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <h6>الجنس :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                   <span v-if="req.user.gender=='male'"
                                                         class="m-badge m-badge--primary m-badge--wide">ذكر</span>
                                                   <span v-else
                                                         class="m-badge m-badge--primary m-badge--wide">أنثى</span>
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            Social Status--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <h6>الحالة الاجتماعية  :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                 <span v-if="req.user.social_status=='single'"
                                                       class="m-badge m-badge--info m-badge--wide">أعزب</span>
                                                   <span v-else class="m-badge m-badge--info m-badge--wide">متزوج</span>
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            Sicantific degree--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                        <h6>الدرجة العلمية  :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.scientific_degree }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            City--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                     <h6>المدينة :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span v-if="req.user.city"
                                                             class="m-widget13__text m-widget13__text-bolder">
												@{{ req.user.city.name }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                               speak_languages--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                     <h6>اللغات التي يتكلمها :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                           <span v-if="req.user.speak_languages">
                                                               <span v-for="(lan ,index) in req.user.lang_array">@{{ __(lan) }}
                                                               <span v-if="index != req.user.lang_array.length-1">&nbsp; , &nbsp;</span>
                                                               </span>
                                                           </span>
                                                           <span v-else>-</span>

												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            Vichel Type--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                    <h6>نوع المركبة :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">

                                                          <span v-if="req.user.vehicle_type=='car'"
                                                                class="m-badge m-badge--info m-badge--wide">
                                                              سيارة
                                                              &nbsp;
                                                          <i class="fa fa-car"></i>
                                                          </span>
                                                           <span v-if="req.user.vehicle_type=='bicycle'"
                                                                 class="m-badge m-badge--info m-badge--wide">
                                                              دراجة هوائية
                                                              &nbsp;
                                                          <i class="fa fa-bicycle"></i>
                                                          </span>
                                                           <span v-if="req.user.vehicle_type=='motorcycle'"
                                                                 class="m-badge m-badge--info m-badge--wide">
                                                              دراجة نارية
                                                              &nbsp;
                                                          <i class="fa fa-motorcycle"></i>
                                                          </span>
                                                           <span v-if="req.user.vehicle_type=='van'"
                                                                 class="m-badge m-badge--info m-badge--wide">
                                                              شاحنة
                                                              &nbsp;
                                                          <i class="fa fa-truck"></i>
                                                          </span>



												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            company--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                    <h6>شركة المركبة :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span v-if="req.user.company"
                                                             class="m-widget13__text m-widget13__text-bolder">
												@{{ req.user.company.name }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            style--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                    <h6>طراز المركبة :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span v-if="req.user.style"
                                                             class="m-widget13__text m-widget13__text-bolder">
												@{{ req.user.style.name }}
												        </span>
                                    </div>
                                </div>

                            </div>
{{--                            model--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                        <h6>موديل المركبة :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span v-if="req.user.model"
                                                             class="m-widget13__text m-widget13__text-bolder">
												@{{ req.user.model.name }}
												        </span>
                                    </div>
                                </div>

                            </div>

{{--                            Passenger no--}}
                            <div v-if="req.user.type=='driver'" class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                     <h6>عدد الركاب :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ req.user.number_of_passengers }}
												        </span>
                                    </div>
                                </div>

                            </div>

{{--                            taxi_no--}}
                            <div class="m-widget13__item">
                                <div class="row">
                                    <div class="col-3">
                                       <h6>لوحة المركبة :</h6>
                                    </div>
                                    <div class="col-9">

                                            <span class="m-widget13__text m-widget13__text-bolder">
													@{{spiltstr(req.user.taxi_number) }}-@{{spiltNo(req.user.taxi_number)}}

												        </span>
                                        </div>
                                    </div>

                                </div>

{{--                            personal_img--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                      <h6>  الصورة الشخصية :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                           <img v-if="req.user.personal_img &&req.user.type=='driver'"
                                                                style="max-height: 100px;cursor: pointer;"
                                                                :src="'https://taxi-api.applaab.com/'+req.user.personal_img"
                                                                @click="openImageModal('https://taxi-api.applaab.com/'+req.user.personal_img)"
                                                                :alt="req.user.personal_img" class="img-thumbnail">
                                                            <img v-if="req.user.personal_img &&req.user.type=='delegate'"
                                                                 style="max-height: 100px;cursor: pointer;"
                                                                 :src="'https://delegate-api.applaab.com/'+req.user.personal_img"
                                                                 @click="openImageModal('https://delegate-api.applaab.com/'+req.user.personal_img)"
                                                                 :alt="req.user.personal_img" class="img-thumbnail">
												        </span>
                                    </div>
                                </div>

                            </div>

{{--                            ID_img--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                     <h6>صورة الهوية الشخصية :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                           <img v-if="req.user.id_img &&req.user.type=='driver'"
                                                                   style="max-height: 100px;cursor: pointer;"
                                                                   :src="'https://taxi-api.applaab.com/'+req.user.id_img"
                                                                   @click="openImageModal('https://taxi-api.applaab.com/'+req.user.id_img)"
                                                                   :alt="req.user.personal_img" class="img-thumbnail">
                                                            <img v-if="req.user.id_img &&req.user.type=='delegate'"
                                                                 style="max-height: 100px;cursor: pointer;"
                                                                 :src="'https://delegate-api.applaab.com/'+req.user.id_img"
                                                                 @click="openImageModal('https://delegate-api.applaab.com/'+req.user.id_img)"
                                                                 :alt="req.user.id_img" class="img-thumbnail">

												        </span>
                                    </div>
                                </div>

                            </div>

{{--                            Licence image--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <h6>صورة رخصة القيادة :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">

                                                         <img v-if="req.user.id_img &&req.user.type=='driver'"
                                                              style="max-height: 100px;cursor: pointer;"
                                                              :src="'https://taxi-api.applaab.com/'+req.user.car_licence_img"
                                                              @click="openImageModal('https://taxi-api.applaab.com/'+req.user.car_licence_img)"
                                                              :alt="req.user.car_licence_img" class="img-thumbnail">
                                                            <img v-if="req.user.car_licence_img &&req.user.type=='delegate'"
                                                                 style="max-height: 100px;cursor: pointer;"
                                                                 :src="'https://delegate-api.applaab.com/'+req.user.car_licence_img"
                                                                 @click="openImageModal('https://delegate-api.applaab.com/'+req.user.car_licence_img)"
                                                                 :alt="req.user.car_licence_img" class="img-thumbnail">

												        </span>
                                    </div>
                                </div>

                            </div>

{{--                            driving_licence--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <h6>صورة رخصة المركبة :</h6>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">

                                                         <img v-if="req.user.driving_licence &&req.user.type=='driver'"
                                                              style="max-height: 100px;cursor: pointer;"
                                                              :src="'https://taxi-api.applaab.com/'+req.user.driving_licence"
                                                              @click="openImageModal('https://taxi-api.applaab.com/'+req.user.driving_licence)"
                                                              :alt="req.user.driving_licence" class="img-thumbnail">
                                                            <img v-if="req.user.driving_licence &&req.user.type=='delegate'"
                                                                 style="max-height: 100px;cursor: pointer;"
                                                                 :src="'https://delegate-api.applaab.com/'+req.user.driving_licence"
                                                                 @click="openImageModal('https://delegate-api.applaab.com/'+req.user.driving_licence)"
                                                                 :alt="req.user.driving_licence" class="img-thumbnail">

												        </span>
                                    </div>
                                </div>

                            </div>

{{--                            vihcle images--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                     <h6>صور المركبة :</h6>
                                    </div>
                                    <div class="col-9">
                                   <span class="m-widget13__text m-widget13__text-bolder">
                                       <span v-if="req.user.vehicle_images&&req.user.type=='driver'">
                                     <img v-for="img in req.user.vehicle_images_array"
                                          style="max-height: 100px; cursor: pointer"
                                          :src="'https://taxi-api.applaab.com/'+img"
                                          @click="openImageModal('https://taxi-api.applaab.com/'+img)"
                                          alt="..." class="img-thumbnail">
                                       </span>
                                       <span v-else-if="req.user.vehicle_images&&req.user.type=='delegate'">
                                     <img v-for="img in req.user.vehicle_images_array "
                                          style="max-height: 100px; cursor: pointer"
                                          :src="'https://delegate-api.applaab.com/'+img"
                                          @click="openImageModal('https://delegate-api.applaab.com/'+img)"
                                          alt="..." class="img-thumbnail">
                                       </span>
                                    </span>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <br>
                        <br>
                        <hr>
                        <div v-if="req.status == 'new'" class="row">
                            <div class="col-9 offset-3">
                                <button @click="acceptRejectRequest(req.id,'accepted')"   class="btn btn-success m-btn--md ">
                                    موافقة
                                </button>

                                <button @click="acceptRejectRequest(req.id,'rejected')"    class="btn btn-danger m-btn--md ">
                                    رفض
                                </button>
                            </div>
                        </div>
                    </div>
            </div>


        {{--Image Preview Modal --}}
        <!-- Modal -->
            <div class="modal fade " id="image_modal" tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">صورة</h5>
                            <button type="button" class="close" @click="closeImageModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img :src="modalImage" :alt="modalImage" class="img-thumbnail">

                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>


        </div>
        </div>
    </confirmation_req-show>
@endsection
