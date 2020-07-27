<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view('dashboard.notifications.index');
    }

    public function data()
    {
        $notifications =  Notification::with('userTo')->orderBy('id','DESC');

        if(request()->has('filter')) {
            $filter = request('filter');
            $orders = $notifications->where(function($query) use($filter){
                //  $query->where('code', 'LIKE', "%$filter%");
                //  ->orWhere('email', 'LIKE', "%$filter%")
                //  ->orWhere('mobile', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $notifications = $notifications->orderBy($fieldName, $order);
        }

        $notifications = $notifications->paginate(10);

        return response()->json(compact('notifications'));
    }
}
