@extends('layouts.app')

@section('content')

    <complaint-show inline-template :complaint='{!! isset($complaint) ? $complaint->toJson() : 'null' !!}'>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <h3 class="m-subheader__title m-subheader__title--separator">الشكاوي</h3>

                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="{{url('dashboard')}}" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                                <a href="{{url('dashboard/complaints')}}" class="m-nav__link">
                                    <span class="m-nav__link-text">شكوى</span>
                                </a>
                            </li>
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                            <span class="m-nav__link">
                                <span class="m-nav__link-text">@{{ complaint.order.code }}</span>
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

                            {{--name--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													 الاسم :
												</span>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ complaint.user.name }}
												        </span>
                                    </div>
                                </div>

                            </div>

                            {{--email--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													 البريد الالكتروني :
												</span>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ complaint.user.email }}
												        </span>
                                    </div>
                                </div>

                            </div>

                            {{--type--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                       <span class="m-widget13__desc m--align-right">نوع المستخدم :</span>
                                    </div>
                                    <div class="col-9">
                                        <span class="m-widget13__text m-widget13__text-bolder">@{{ complaint.type }}</span>
                                    </div>
                                </div>

                            </div>

                            {{--order --}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                  <span class="m-widget13__desc m--align-right">الطلبية :</span>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                           <span v-if="complaint.order">@{{ complaint.order.code }}</span>
                                                           <span v-else>-</span>
												        </span>
                                    </div>
                                </div>

                            </div>

                            {{--Status--}}
                            <div class="m-widget13__item">
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                       <span class="m-widget13__desc m--align-right">حالة الشكوى :</span>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
                                                   <span v-if="complaint.status=='new'"
                                                         class="m-badge m-badge--primary m-badge--wide">جديدة</span>
                                                     <span v-else-if="complaint.status=='open'"
                                                           class="m-badge m-badge--primary m-badge--wide">مفتوحة</span>
                                                   <span v-else
                                                         class="m-badge m-badge--primary m-badge--wide">مغلقة</span>
												        </span>
                                    </div>
                                </div>

                            </div>

                            {{--reason--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													 سبب الشكوى  :
												</span>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													@{{ complaint.reason.name }}
												        </span>
                                    </div>
                                </div>

                            </div>



                            {{--text--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													نص الشكوى :
												</span>
                                    </div>
                                    <div class="col-9">
                                                       <span
                                                             class="m-widget13__text m-widget13__text-bolder">
												@{{ complaint.text }}
												        </span>
                                    </div>
                                </div>

                            </div>



                            {{--Complaint images --}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													صور الشكوى :
												</span>
                                    </div>
                                    <div class="col-9">
                                                       <span class="m-widget13__text m-widget13__text-bolder">
													{{--@{{ delegate.vehicle_type }}--}}
                                                           <span v-if="complaint.photos">
                                                         <img v-for="img in complaint.image_array "
                                                              style="max-height: 100px; cursor: pointer"
                                                              :src="'/storage/'+img" @click="openImageModal(img)"
                                                              alt="..." class="img-thumbnail">
                                                           </span>
                                                           <span v-else>-</span>

												        </span>
                                    </div>
                                </div>

                            </div>

                            {{--admin notes--}}
                            <div class="m-widget13__item">

                                <div class="row">
                                    <div class="col-3">
                                                       <span class="m-widget13__desc m--align-right">
													ملاحظات المدير :
												</span>
                                    </div>
                                    <div class="col-9" v-if="complaint.status!='open'">
                                         <span v-if="complaint.admin_notes" class="m-widget13__text m-widget13__text-bolder">@{{ complaint.admin_notes }}</span>
                                         <span v-else class="m-widget13__text m-widget13__text-bolder">-</span>
                                    </div>
                                    <div class="col-9" v-else>
                                        <textarea v-model="admin_notes" class="form-control" style="resize: none" rows="10"  >@{{ complaint.admin_notes }}</textarea>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="col-12">
                        <br>
                        <br>
                        <hr>
                        <div  class="row">
                            <div class="col-9 offset-3">
                                <button  v-if="complaint.status == 'new'" @click="openCloseComplaint(complaint.id,'open')"   class="btn btn-success m-btn--md ">
                                    فتح
                                </button>

                                <button  v-if="complaint.status == 'new'||complaint.status == 'open'" @click="openCloseComplaint(complaint.id,'closed')"  class="btn btn-danger m-btn--md ">
                                    اغلاق
                                </button>
                            </div>
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
                            <img :src="'/storage/'+modalImage" :alt="modalImage" class="img-thumbnail">

                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </complaint-show>
@endsection