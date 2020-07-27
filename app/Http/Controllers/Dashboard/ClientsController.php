<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use App\Models\Complaint;
use App\Models\PackageOrder;
use App\Models\TaxiOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function index()
    {
        return view('dashboard.clients.index');
    }

    public function data()
    {
        $Admins = new Client();

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

    public function show(Client $client){
        $delegate=Client::where('id',$client->id)
            ->with('city')
            ->withCount('completedPackageOrders','canceledPackageOrders','completedTaxiOrders','canceledTaxiOrders')
            ->first();
        //return $delegate;
        return view('dashboard.clients.show',compact('delegate'));
    }

    public function getPackageOrders(Client $client){
        $orders = PackageOrder::with('delegate')
            ->where('client_id',$client->id)
            ->orderBy('id', 'DESC');

        $orders = $orders->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getTaxiOrders(Client $client){
        $orders = TaxiOrder::with('driver')
            ->where('client_id',$client->id)
            ->orderBy('id', 'DESC');

        $orders = $orders->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComments(Client $client){

        $orders = $client->rating()->whereNotNull('comment')->with('order','userFrom')->paginate(10);

        return response()->json(compact('orders'));

    }

    public function getComplaints(Client $client){

        $taxi_orders_ids=$client->taxiOrders()->pluck('id');
        $package_orders_ids=$client->PackageOrders()->pluck('id');

        $orders = Complaint::with('user','reason','order')
            ->where(function ($q) use ($taxi_orders_ids){
                $q->where('order_type',TaxiOrder::class);
                $q->whereIn('order_id',$taxi_orders_ids);
            })
            ->orWhere(function ($qq) use ($package_orders_ids){
                $qq->where('order_type',PackageOrder::class);
                $qq->whereIn('order_id',$package_orders_ids);
            })
            ->paginate(10);

        return response()->json(compact('orders'));

    }
}
