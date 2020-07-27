<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Complaint;
use App\Models\CouponsUse;
use App\Models\Delegate;
use App\Models\Invoice;
use App\Models\PackageOrder;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DelegateController extends Controller
{
    public function index()
    {
        return view('dashboard.delegates.index');
    }

    public function data()
    {
        $Admins =  Delegate::whereNotNull('confirmation_date');

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

    public function show(Delegate $delegate){
        $delegate=Delegate::where('id',$delegate->id)
            ->with('city','company','style','model','bank')
            ->withCount('pendingOrders','completedOrders','canceledOrders')
            ->first();
///////////////////////
        $delegate->total_income=PackageOrder::where('user_id',$delegate->id)
            ->whereIn('status',['delivery_confirmed','reception_confirmed'])
            ->sum('total_price');

        $orders_ids=PackageOrder::where('user_id',$delegate->id)
            ->whereIn('status',['delivery_confirmed','reception_confirmed'])
            ->pluck('id')->toArray();

        $total_profit=Invoice::where('order_type',PackageOrder::class)
            ->whereIn('order_id',$orders_ids)->sum('value');

        $cuopon_use_discount=CouponsUse::where('order_type',PackageOrder::class)
            ->whereIn('order_id',$orders_ids)->sum('discount_value');

        $delegate->net_profit= $total_profit - $cuopon_use_discount;

        $delegate->paied_to_system=Payment::where('user_id',$delegate->id)
            ->where('type','to_admin')->sum('value');

        if($delegate->budget >=0){
            $delegate->remain_to_system=0;
            $delegate->remain_to_driver=$delegate->budget;
        }else{
            $delegate->remain_to_system=$delegate->budget;
            $delegate->remain_to_driver=0;
        }


        //return $delegate;



        return view('dashboard.delegates.show',compact('delegate'));
    }

    public function orders(Delegate $delegate){
        $orders = PackageOrder::with('client')
            ->where('user_id',$delegate->id)
            ->orderBy('id', 'DESC');

        $orders = $orders->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComments(Delegate $delegate){

        $orders = $delegate->rating()->whereNotNull('comment')->with('order','userFrom')->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComplaints(Delegate $delegate){

        $orders_ids=$delegate->orders()->pluck('id');
        $orders = Complaint::with('user','reason','order')->where('order_type',PackageOrder::class)
            ->whereIn('order_id',$orders_ids)
            ->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getPayments(Delegate $delegate){

        $orders = Payment::where('user_id',$delegate->id)

            ->with('user','admin')->paginate(10);

        return response()->json(compact('orders'));

    }
    public function changeActive(Delegate $delegate){
            if( $delegate->active==0){
                $delegate->active=1;
            }else{
                $delegate->active=0;
            }
        $delegate->save();

        return redirect()->route('delegates');

    }
}
