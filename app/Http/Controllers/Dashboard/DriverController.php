<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Complaint;
use App\Models\CouponsUse;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\TaxiOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function index()
    {
        return view('dashboard.drivers.index');
    }

    public function data()
    {
        $Admins = Driver::whereNotNull('confirmation_date');

        if(request()->has('filter')) {
            $filter = request('filter');
            $Admins = $Admins->where(function($query) use($filter){
                $query->where('name', 'LIKE', "%$filter%")
                    ->orWhere('email', 'LIKE', "%$filter%")
                    ->orWhere('mobile', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $Admins = $Admins->orderBy($fieldName, $order);
        }

        $users = $Admins->paginate(10);

        return response()->json(compact('users'));
    }

    public function show(Driver $driver){
        $delegate=Driver::where('id',$driver->id)
            ->with('city','company','model','style','bank')
            ->withCount('pendingOrders','completedOrders','canceledOrders')
            ->first();

        $delegate->total_income=TaxiOrder::where('user_id',$driver->id)
            ->where('status','reception_confirm')
            ->sum('total_price');

        $orders_ids=TaxiOrder::where('user_id',$driver->id)
            ->where('status','reception_confirm')
            ->pluck('id')->toArray();

        $total_profit=Invoice::where('order_type',TaxiOrder::class)
            ->whereIn('order_id',$orders_ids)->sum('value');

        $cuopon_use_discount=CouponsUse::where('order_type',TaxiOrder::class)
            ->whereIn('order_id',$orders_ids)->sum('discount_value');

        $delegate->net_profit= $total_profit - $cuopon_use_discount;

        $delegate->paied_to_system=Payment::where('user_id',$driver->id)
            ->where('type','to_admin')->sum('value');

        if($delegate->budget >=0){
            $delegate->remain_to_system=0;
            $delegate->remain_to_driver=$delegate->budget;
        }else{
            $delegate->remain_to_system=$delegate->budget;
            $delegate->remain_to_driver=0;
        }


        //return $delegate;
        return view('dashboard.drivers.show',compact('delegate'));
    }

    public function orders(Driver $driver){
        $orders = TaxiOrder::with('client')
            ->where('user_id',$driver->id)
            ->orderBy('id', 'DESC');

        $orders = $orders->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComments(Driver $driver){

        $orders = $driver->rating()->whereNotNull('comment')->with('order','userFrom')->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComplaints(Driver $driver){

        $orders_ids=$driver->orders()->pluck('id');
        $orders = Complaint::with('user','reason','order')->where('order_type',TaxiOrder::class)
            ->whereIn('order_id',$orders_ids)
            ->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getPayments(Driver $driver){

        $orders = Payment::where('user_id',$driver->id)

            ->with('user','admin')->paginate(10);

        return response()->json(compact('orders'));

    }
    public function changeActive(Driver $driver){
        if( $driver->active==0){
            $driver->active=1;
        }else{
            $driver->active=0;
        }
        $driver->save();
        return redirect()->route('drivers');

    }
}
