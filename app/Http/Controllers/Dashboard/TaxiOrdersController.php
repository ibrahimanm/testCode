<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Complaint;
use App\Models\TaxiOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxiOrdersController extends Controller
{
    public function index()
    {
        return view('dashboard.taxi_orders.index');
    }

    public function data()
    {
        $orders =  TaxiOrder::with('client','driver')->orderBy('id','DESC');

        if(request()->has('filter')) {
            $filter = request('filter');
            $orders = $orders->where(function($query) use($filter){
                $query->where('code', 'LIKE', "%$filter%");
                  //  ->orWhere('email', 'LIKE', "%$filter%")
                  //  ->orWhere('mobile', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $orders = $orders->orderBy($fieldName, $order);
        }

        $orders = $orders->paginate(10);

        return response()->json(compact('orders'));
    }

    public function show(TaxiOrder $order)
    {
        $order=TaxiOrder::where('id',$order->id)
            ->with('client','driver')
            ->first();
        //return $delegate;
        return view('dashboard.taxi_orders.show', compact('order'));
    }

    public function getComments(TaxiOrder $order){
        $orders = $order->rating()
            ->whereNotNull('comment')
            ->with('order','userFrom')->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComplaints(TaxiOrder $order){

        $orders_ids=$order->complaint()->pluck('id');
        $orders = Complaint::with('user','reason','order')
            ->whereIn('id',$orders_ids)
            ->paginate(10);

        return response()->json(compact('orders'));

    }
}
