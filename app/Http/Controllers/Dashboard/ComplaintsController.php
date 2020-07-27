<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintsController extends Controller
{
    public function index()
    {
        return view('dashboard.complaints.index');
    }

    public function data()
    {
        $complaints =  Complaint::with('user','order')->orderBy('id','DESC');

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
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $complaints = $complaints->orderBy($fieldName, $order);
        }

        $complaints = $complaints->paginate(10);

        return response()->json(compact('complaints'));
    }

    public function show(Complaint $complaint){
        $complaint=Complaint::where('id',$complaint->id)
            ->with('user','order','reason')
            ->first();
        return view('dashboard.complaints.show',compact('complaint'));
    }

    public function openCloseComplaint(Request $request){
        $request->validate([
            'id' => 'required|numeric|exists:complaints,id',
            'status' => 'required|in:"open","closed"',
            //'admin_notes' => '',
        ]);

        $conf_req=Complaint::find($request->id);
        $conf_req->status=$request->status;
        $conf_req->admin_notes=$request->admin_notes;
        $conf_req->admin_id=auth()->user()->id;
        $conf_req->save();

        return response()->json(['message' => 'تمت العملية بنجاح']);

    }
}
