<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class AdminController extends Controller

{
    public function index()
    {
        return view('dashboard.admins.index');
    }

    public function data()
    {
        $Admins = new Admin();

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

    public function create()
    {
        return view('dashboard.admins.form');
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric|unique:admins,mobile',
            'email' => 'required|unique:admins,email',
            'password' => 'required|min:5',
            'active' => 'required',
        ]);

        DB::transaction(function () use($request) {

            $Admin = Admin::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'active' => $request->active,

            ]);


        });

        return response()->json(['message' => trans('messages.saved_successfully')]);
    }

    public function edit(Admin $admin)
    {
        $user= $admin;
        return view('dashboard.admins.form', compact('user'));
    }

    public function update(Admin $admin, Request $request)
    {


        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric|unique:admins,mobile,'.$admin->id,
            'email' => 'required|unique:admins,email,'.$admin->id,
            'active' => 'required',
        ]);

        DB::transaction(function() use($admin, $request) {

            $admin->name = $request->name;
            $admin->mobile = $request->mobile;
            $admin->email = $request->email;
            $admin->password = $request->password ? bcrypt($request->password) : $admin->password;
            $admin->active = $request->active;

            $admin->save();

        });

        return response()->json(['message' => trans('messages.updated_successfully')]);
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(['message' => trans('messages.deleted_successfully')]);
    }
}
