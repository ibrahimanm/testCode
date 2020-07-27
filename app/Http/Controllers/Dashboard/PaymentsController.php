<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Delegate;
use App\Models\Driver;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function index()
    {
        return view('dashboard.payments.index');
    }

    public function data()
    {
        $complaints =  Payment::with('user','admin')
            ->orderBy('id','DESC');

        if(request()->has('filter')) {
            $filter = request('filter');
            $orders = $complaints->where(function($query) use($filter){
                //  $query->where('code', 'LIKE', "%$filter%");
                //  ->orWhere('email', 'LIKE', "%$filter%")
                //  ->orWhere('mobile', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = (array_key_exists("fieldName",$sort) && $sort['fieldName'] && strlen($sort['fieldName'])) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $complaints = $complaints->orderBy($fieldName, $order);
        }

        $payments = $complaints->paginate(10);

        return response()->json(compact('payments'));
    }

    public function create()
    {
        return view('dashboard.payments.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:"from_admin","to_admin"',
            'value' => 'required|numeric',
            'user_type' => 'required|in:"delegate","driver"',
            'delegate' => 'required_if:user_type,delegate',
            'driver' => 'required_if:user_type,driver',
            'payment_method' => 'required|in:"cash","visa","bank_transfer"',
            'image' => 'required_if:payment_method,bank_transfer',
        ],[],[
            'type' =>'نوع العملية',
            'delegate' =>'المندوب',
            'driver' =>'السائق',
            'user_type' =>'نوع المستخدم',
        ]);

        $payment= new Payment();
        $payment->type= $request->type;
        if($request->delegate){
            $payment->user_id= $request->delegate;
        }else{
            $payment->user_id= $request->driver;
        }
        $payment->admin_id= auth()->user()->id;
        $payment->value= $request->value;
        $payment->payment_method= $request->payment_method;
        $payment->file= $request->file;
        if($payment->save()){
            $user=User::find($payment->user_id);
            if($request->type=='from_admin'){
                $user->budget=$user->budget-$payment->value;
            }elseif ($request->type=='to_admin'){
                $user->budget=$user->budget+$payment->value;
            }
            $user->save();

        }

        $message = 'تم الحفظ بنجاح';

        return response()->json(compact('message'));

    }

    public function searchDrivers(Request $request){

     $drivers=Driver::where('name','LIKE',"%$request->search%")
         ->get()
         ->map(function ($m){
         return[
             'value'=>$m->id,
             'name'=>$m->name,
         ];
     });

     return response(json_encode($drivers));
    }


    public function searchDelegates(Request $request){
        $delegates=Delegate::where('name','LIKE',"%".$request->search."%")
            ->get()
            ->map(function ($m){
                return[
                    'value'=>$m->id,
                    'name'=>$m->name,
                ];
            });

        return response(json_encode($delegates));
    }

    public function confirm(Request $request){
        $payment=Payment::find($request->id);
        $user=user::find($payment->user_id);
        $payment->status='confirm';
        if ( $payment->type=='to_admin'){
            $user->budget=$user->budget+$payment->value;
        }
        if( $payment->type=='from_admin'){
            $user->budget=$user->budget-$payment->value;
        }
        $payment->save();
        $user->save();
        $message = 'تم الحفظ بنجاح';
        return response()->json(compact('message'));

    }
}
