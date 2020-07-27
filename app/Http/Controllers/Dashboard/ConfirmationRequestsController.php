<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\ConfirmationRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfirmationRequestsController extends Controller
{
    public function index()
    {
        return view('dashboard.confirmation_requests.index');
    }

    public function data()
    {
        $confirmation_req =  ConfirmationRequest::with('user')->orderBy('id','DESC');

        if(request()->has('filter')) {
            $filter = request('filter');
            $confirmation_req = $confirmation_req->whereHas('user',function($query) use($filter){
                $query->where('name', 'LIKE', "%$filter%")
                    ->orWhere('email', 'LIKE', "%$filter%")
                    ->orWhere('mobile', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $confirmation_req = $confirmation_req->orderBy($fieldName, $order);
        }

        $users = $confirmation_req->paginate(10);

        return response()->json(compact('users'));
    }

    public function acceptRejectRequest(Request $request){
        $request->validate([
            'req_id' => 'required|numeric|exists:confirmation_requests,id',
            'status' => 'required|in:"accepted","rejected"',
        ]);

        $conf_req=ConfirmationRequest::find($request->req_id);
        $conf_req->status=$request->status;
        $conf_req->admin_id=auth()->user()->id;

        if($request->status=="accepted")
        $conf_req->accepted_date=Carbon::now();

        if($conf_req->save() && $request->status=="accepted"){
            $user=User::find($conf_req->user_id);
            $user->active=1;
            $user->confirmation_date=Carbon::now();
            $pass=rand(10000,99999);
            $user->password=bcrypt($pass);
            if($user->save()&& $user->type=='driver'){
                $msg='عزيزي كابتن كروة: تم اعتمادك لتكون أحد كباتن كروة المتحدة لخدمة المركبات الموجهة'.' '.$pass;
                sendSMS($user->mobile,$msg);
            }elseif ($user->save()&& $user->type=='delegate'){
                $msg=' مندوب كروة: تم اعتمادك لتكون أحد مندوبي  كروة المتحدة لخدمات توصيل الطلبات'.' '.$pass;
                sendSMS($user->mobile,$msg);
            }
        }

        return response()->json(['message' => 'تمت العملية بنجاح']);

    }

    public function show(ConfirmationRequest $req)
    {
        $req=ConfirmationRequest::where('id',$req->id)
            ->with('user.city','user.bank','user.company','user.style','user.model')
            ->first();
        //return $delegate;
//        dd($req);
        return view('dashboard.confirmation_requests.show', compact('req'));
    }
}
