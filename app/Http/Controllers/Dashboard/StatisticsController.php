<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use App\Models\Cities;
use App\Models\Client;
use App\Models\Complaint;
use App\Models\ComplaintReason;
use App\Models\CouponsUse;
use App\Models\Delegate;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\PackageOrder;
use App\Models\TaxiOrder;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $delegates_statistics=array(
            [
                'name'=> 'مفعل',
                'y'=> Delegate::where('active',1)->count(),

            ],[
                'name' =>'موقوف',
                'y'=> Delegate::where('active',0)->count(),
                'sliced'=> true,
                'selected'=> true,
            ]);

        $drivers_statistics=array(
            [
                'name'=> 'مفعل',
                'y'=> Driver::where('active',1)->count(),

            ],[
                'name' =>'موقوف',
                'y'=> Driver::where('active',0)->count(),
                'sliced'=> true,
                'selected'=> true,
            ]);

        $clients_statistics=array(
            [
                'name'=> 'مفعل',
                'y'=> Client::where('active',1)->count(),

            ],[
                'name' =>'موقوف',
                'y'=>Client::where('active',0)->count(),
                'sliced'=> true,
                'selected'=> true,
            ]);

        $package_orders_statistics=array(
            [
                'name'=> 'جديد',
                'y'=> PackageOrder::where('status','new')->count(),

            ],[
                'name' =>'مؤكدة',
                'y'=> PackageOrder::where('status','confirmed')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],
            [
                'name' =>'الوصول الى المتجر',
                'y'=> PackageOrder::where('status','arrive_to_store')->count(),

            ],
            [
                'name' =>'الطلب من المتجر',
                'y'=> PackageOrder::where('status','ask_order_store')->count(),

            ],
            [
                'name' =>'استلام الطلب',
                'y'=> PackageOrder::where('status','receive_order_store')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],
            [
                'name' =>'في الطريق',
                'y'=> PackageOrder::where('status','in_way')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],
            [
                'name' =>'الوصول لموقع العميل',
                'y'=> PackageOrder::where('status','arrive_to_client_location')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],
            [
                'name' =>'تأكيد التسليم',
                'y'=> PackageOrder::where('status','delivery_confirmed')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],[
                'name' =>'تأكيد الاستلام',
                'y'=> PackageOrder::where('status','reception_confirmed')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],[
                'name' =>'ملغي',
                'y'=> PackageOrder::where('status','canceled')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],

        );

        $taxi_orders_statistics=array(
            [
                'name'=> 'جديد',
                'y'=> TaxiOrder::where('status','new')->count(),

            ],[
                'name' =>'تأكيد السائق',
                'y'=> TaxiOrder::where('status','driver_confirm')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],
            [
                'name' =>'السائق في الانتظار',
                'y'=> TaxiOrder::where('status','driver_waiting')->count(),

            ],
            [
                'name' =>'في الطريق',
                'y'=> TaxiOrder::where('status','in_way')->count(),

            ],
            [
                'name' =>'تم التوصيل',
                'y'=> TaxiOrder::where('status','reception_confirm')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],
            [
                'name' =>'ملغي',
                'y'=> TaxiOrder::where('status','canceled')->count(),
                'sliced'=> true,
                'selected'=> true,
            ],

        );

        $complains_statistics_client=array(
            'data'=>[Complaint::where('user_type',Client::class)->where('reason_id',1)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',2)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',3)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',4)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',5)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',6)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',7)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',8)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',9)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',10)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',11)->count(),
                Complaint::where('user_type',Client::class)->where('reason_id',12)->count(),
            ],
            // 'category'=>['الطلب تأخر', 'لم يتم تسليم الطلب', 'المرسول غير مهذب' ,'أسباب أخرى']
            'category'=>ComplaintReason::pluck('name')->toArray(),
        );

        $complains_statistics_delegate=array(
            'data'=>[Complaint::where('user_type',Delegate::class)->where('reason_id',1)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',2)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',3)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',4)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',5)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',6)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',7)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',8)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',9)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',10)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',11)->count(),
                Complaint::where('user_type',Delegate::class)->where('reason_id',12)->count(),
            ],
            // 'category'=>['الطلب تأخر', 'لم يتم تسليم الطلب', 'المرسول غير مهذب' ,'أسباب أخرى']
            'category'=>ComplaintReason::pluck('name')->toArray(),
        );

        $complains_statistics_drivers=array(
            'data'=>[Complaint::where('user_type',Driver::class)->where('reason_id',1)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',2)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',3)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',4)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',5)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',6)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',7)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',8)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',9)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',10)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',11)->count(),
                Complaint::where('user_type',Driver::class)->where('reason_id',12)->count(),
            ],
            // 'category'=>['الطلب تأخر', 'لم يتم تسليم الطلب', 'المرسول غير مهذب' ,'أسباب أخرى']
            'category'=>ComplaintReason::pluck('name')->toArray(),
        );


        $users_cities=Cities::select(DB::raw("*,(select count(*) from `clients` as `pt`where `pt`.`city_id`=`cities`.`id` )  as user_count"))
            ->orderBy('user_count','desc')
            ->take(10)
            ->get();

        $cities=$users_cities->pluck('name')->toArray();
        $cities_user_count=$users_cities->pluck('user_count')->toArray();

        $statistics=[
            'delegate_count' =>Delegate::count(),
            'clients_count' =>Client::count(),
            'admins_count' =>Admin::count(),
            'drivers_count' =>Driver::count(),
            'package_order_count' =>PackageOrder::count(),
            'taxi_order_count' =>TaxiOrder::count(),
            'canceled_package_orders_count' =>PackageOrder::where('status','canceled')->count(),
            'canceled_taxi_orders_count' =>TaxiOrder::where('status','canceled')->count(),
            'clients_statistics' =>$clients_statistics,
            'delegates_statistics' =>$delegates_statistics,
            'drivers_statistics' =>$drivers_statistics,
            'package_orders_statistics' =>$package_orders_statistics,
            'taxi_orders_statistics' =>$taxi_orders_statistics,
            'complains_statistics_client' =>$complains_statistics_client,
            'complains_statistics_delegate' =>$complains_statistics_delegate,
            'complains_statistics_drivers' =>$complains_statistics_drivers,
            'cities' =>$cities,
            'cities_user_count' =>$cities_user_count,
        ];

        $statistics=json_encode($statistics);

        return view('dashboard.statistics.index',compact('statistics'));
    }

    public function getStatistics(Request $request){

        $total_budget=User::where('active',1)->sum('budget');

        $drivers_budget=Driver::where('active',1)->sum('budget');

        $delegate_budget=Delegate::where('active',1)->sum('budget');

        $total_profit=Invoice::where('active',1)->sum('value');

        $total_coupons_discount=CouponsUse::sum('discount_value');

        $net_profit=$total_profit - $total_coupons_discount;

        $total_income=Invoice::where('active',1)->sum('delivery_price');

        $total_delegate_dept=Delegate::where('budget','<','0')->sum('budget');
        $total_driver_dept=Driver::where('budget','<','0')->sum('budget');

        return response(compact('total_budget',
                                'drivers_budget',
                                'delegate_budget',
                                'net_profit',
                                'total_income',
                                'total_delegate_dept',
                                'total_driver_dept'
                        ));
    }
}
