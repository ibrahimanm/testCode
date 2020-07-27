@extends('layouts.app')

@push('styles')
    <style>
        .el-date-editor .el-range-separator {
            padding: 2px 23px;
            width: 10%;
        }
        .block{
            margin: 10px auto;
        }
    </style>
    @endpush

@section('content')
    <statistics-index :statistics='{!! isset($statistics) ? $statistics : 'null' !!}' inline-template>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">الاحصائيات</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">


                </div>
            </div>
            <div class="m-portlet__body">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-warning">
                                <h4 class="m-widget24__title text-light">
                                    عدد المشتركين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الاجمالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.clients_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-brand">
                                <h4 class="m-widget24__title text-light">
                                    عدد المندوبين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الاجمالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.delegate_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-accent">
                                <h4 class="m-widget24__title text-light">
                                    عدد السائقين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الاجمالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.drivers_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-accent">
                                <h4 class="m-widget24__title text-light">
                                    عدد المديرين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الاجمالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.admins_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                </div>
                <br>
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-warning">
                                <h4 class="m-widget24__title text-light">
                                    عدد الطلبات
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													طلبات التوصيل
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.package_order_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-brand">
                                <h4 class="m-widget24__title text-light">
                                    عدد الطلبات
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													طلبات التاكسي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.taxi_order_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item  m--bg-danger">
                                <h4 class="m-widget24__title text-light">
                                    عدد الطلبات الملغاة
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													طلبات التوصيل
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.canceled_package_orders_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-danger">
                                <h4 class="m-widget24__title text-light">
                                    عدد الطلبات الملغاة
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													طلبات التاكسي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ statistics.canceled_taxi_orders_count }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                </div>

                <br>
                {{--$$$$$$/**/*//**/Mony/*//**/$$$$$$$$--}}
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-info">
                                <h4 class="m-widget24__title text-light">
                                    رصيد النظام
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الحالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ total_budget }} {{ CURRENCY }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-info">
                                <h4 class="m-widget24__title text-light">
                                    رصيد المندوبين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الحالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ delegate_budget }} {{ CURRENCY }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-info">
                                <h4 class="m-widget24__title text-light">
                                   رصيد السائقين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الحالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ drivers_budget }} {{ CURRENCY }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-brand">
                                <h4 class="m-widget24__title text-light">
                                    أرباح النظام
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الاجمالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ net_profit }} {{ CURRENCY }}

												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                </div>

                <br>
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-info">
                                <h4 class="m-widget24__title text-light">
                                   دخل النظام
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الاجمالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ total_income }} {{ CURRENCY }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-info">
                                <h4 class="m-widget24__title text-light">
                                    مجموع ديون المندوبين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الحالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ Math.abs(total_delegate_dept) }} {{ CURRENCY }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item m--bg-info">
                                <h4 class="m-widget24__title text-light">
                                    مجموع ديون السائقين
                                </h4><br>
                                <span class="m-widget24__desc text-light">
													الحالي
												</span>
                                <span class="m-widget24__stats  text-light">
													@{{ Math.abs(total_driver_dept) }} {{ CURRENCY }}
												</span>
                                <div class="m--space-10"></div>
                                <br>

                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>



                </div>

                <div class="clearfix"></div>
                <hr>

                <br>
                <div class="row">
                    <div class="block">

                        <el-date-picker
                                v-model="search_date"
                                type="daterange"
                                range-separator="إلى"
                                start-placeholder="من تاريخ"
                                end-placeholder="الى تاريخ">
                        </el-date-picker>
                    </div>
                </div>

                <br>
                <br>

                {{--/**//*//*Statistics Chart box/**/*//*/*--}}
                <div class="row">


                    <div class="col-sm-4">
                        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                                                    <span class="m-portlet__head-icon">
                                                                        <i class="flaticon-multimedia"></i>
                                                                    </span>
                                        <h3 class="m-portlet__head-text">
                                            العملاء
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <highcharts :options="clients_statistics" ref="highcharts1"></highcharts>
                            </div>
                            <div class="m-portlet__foot m--hide">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4">
                        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                                                    <span class="m-portlet__head-icon">
                                                                        <i class="flaticon-multimedia"></i>
                                                                    </span>
                                        <h3 class="m-portlet__head-text">
                                            المندوبين
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <highcharts :options="delegates_statistics" ref="highcharts2"></highcharts>
                            </div>
                            <div class="m-portlet__foot m--hide">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                                                    <span class="m-portlet__head-icon">
                                                                        <i class="flaticon-multimedia"></i>
                                                                    </span>
                                        <h3 class="m-portlet__head-text">
                                            السائقين
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <highcharts :options="drivers_statistics" ref="highcharts3"></highcharts>
                            </div>
                            <div class="m-portlet__foot m--hide">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                                                    <span class="m-portlet__head-icon">
                                                                        <i class="flaticon-multimedia"></i>
                                                                    </span>
                                        <h3 class="m-portlet__head-text">
                                            طلبيات التوصيل
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <highcharts :options="package_orders_statistics" ref="highcharts4"></highcharts>
                            </div>
                            <div class="m-portlet__foot m--hide">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                                                    <span class="m-portlet__head-icon">
                                                                        <i class="flaticon-multimedia"></i>
                                                                    </span>
                                        <h3 class="m-portlet__head-text">
                                            مشاوير التاكسي
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <highcharts :options="taxi_orders_statistics" ref="highcharts5"></highcharts>
                            </div>
                            <div class="m-portlet__foot m--hide">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                                                    <span class="m-portlet__head-icon">
                                                                        <i class="flaticon-multimedia"></i>
                                                                    </span>
                                        <h3 class="m-portlet__head-text">
                                           الشكاوى
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <highcharts :options="options_complaint" ref="highcharts6"></highcharts>
                            </div>
                            <div class="m-portlet__foot m--hide">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="m-portlet m-portlet--primary m-portlet--head-solid-bg">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                                                    <span class="m-portlet__head-icon">
                                                                        <i class="flaticon-multimedia"></i>
                                                                    </span>
                                        <h3 class="m-portlet__head-text">
                                           توزيع العملاء على المدن
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <highcharts :options="options_cities" ref="highcharts7"></highcharts>
                            </div>
                            <div class="m-portlet__foot m--hide">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                    {{--/**//*//*/**/*//*/*--}}


            </div>
            <!--end::Form-->
        </div>
    </statistics-index>
@endsection
