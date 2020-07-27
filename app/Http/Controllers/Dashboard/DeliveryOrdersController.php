<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Complaint;
use App\Models\PackageOrder;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryOrdersController extends Controller
{
    public function index()
    {
        return view('dashboard.delivery_orders.index');
    }

    public function data()
    {
        $orders = PackageOrder::with('client', 'delegate')->orderBy('id', 'DESC');

        if (request()->has('filter')) {
            $filter = request('filter');
            $orders = $orders->where(function ($query) use ($filter) {
                $query->where('code', 'LIKE', "%$filter%");
                //  ->orWhere('email', 'LIKE', "%$filter%")
                //  ->orWhere('mobile', 'LIKE', "%$filter%");
            });
        }
        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $orders = $orders->orderBy($fieldName, $order);
        }

        $orders = $orders->paginate(10);

        return response()->json(compact('orders'));
    }

    public function show(PackageOrder $order)
    {
        $order=PackageOrder::where('id',$order->id)
            ->with('client','delegate')
            ->first();
        //return $delegate;
        return view('dashboard.delivery_orders.show', compact('order'));
    }

    public function getComments(PackageOrder $order){
        $orders = $order->rating()
            ->whereNotNull('comment')
            ->with('order','userFrom')->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComplaints(PackageOrder $order){

        $orders_ids=$order->complaint()->pluck('id');
        $orders = Complaint::with('user','reason','order')
            ->whereIn('id',$orders_ids)
            ->paginate(10);

        return response()->json(compact('orders'));

    }
}