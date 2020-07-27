<?php

namespace App\Http\Controllers\API;

use App\Models\AddressesBook;
use App\Models\Cities;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\CouponsUse;
use App\Models\Setting;
use App\Models\TempClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    //TO SEND VERIFICATION CODE SMS TO MOBILE
    public function sendVerificationCode(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits_between:5,15',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $temp_client=TempClient::where('mobile',$request->mobile)->first();

        //////Generate code//////
        $verification_code= mt_rand(1000, 9999);
        ///////////
        ///
        if($temp_client){

            //Max number of sms 3 after hour you can try again and between two sms 1 minute
            if((Carbon::createFromFormat('Y-m-d H:i:s', $temp_client->last_sms_time)->diffInMinutes(Carbon::now()->format('Y-m-d H:i:s')) <= 60 && $temp_client->sms_count >= 5)||Carbon::createFromFormat('Y-m-d H:i:s', $temp_client->last_sms_time)->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())) < 60){
                $message = "لقد وصلت للحد الأقصى لرسائل التفعيل الرجاء المحاولة بعد فترة";
                $data = [];
                $code = 422;
                $status = false;
                return prepareResult($status, $data, $message,$code);
            }else{
                $temp_client->verification_code=$verification_code;
                $temp_client->sms_count=$temp_client->sms_count+1;
                $temp_client->last_sms_time=Carbon::now();
                $temp_client->save();

                $message = "تمت العملية بنجاح";
                $data = $temp_client;
                $code = 200;
                $status = true;
            }

        }else{
            $temp=new TempClient();
            $temp->mobile=$request->mobile;
            $temp->verification_code=$verification_code;
            $temp->sms_count=1;
            $temp->last_sms_time=Carbon::now();
            $temp->save();

            $message = "تمت العملية بنجاح";
            $data = $temp;
            $code = 200;
            $status = true;
        }

        /////////////Send SMS//////////////////

        sendSMS($request->mobile, "كود التحقق: " . $verification_code);

        /////////////Send SMS//////////////////

        return prepareResult($status, $data, $message,$code);
    }

    /*TO IF VERIFICATION CODE IS OK IF USER IS EXIST SEND
    ACCESS TOKEN TO THE USER ELSE SEND OK TO COMPLETE REGISTER */
    public function checkVerificationCode(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits_between:5,15|exists:temp_clients',
            'verification_code' => 'required',
        ],[],[
            'mobile' => 'رقم الجوال',
            'verification_code' => 'كود التحقق',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }
        $temp=TempClient::where('mobile',$request->mobile)->first();
        if($temp->verification_code != $request->verification_code){
            $message = "كود التحقق غير صحيح";
            $data = [];
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }
        $client=Client::where('mobile',$request->mobile)->first();
        if($client){

            $client->device_token = $request->device_token;
            $client->password =Hash::make($request->verification_code);
            $client->save();

            $request->request->add([
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'username' => $request->mobile,
                'password' => $request->verification_code,
                'scope' => null,
            ]);


            $proxy = Request::create(
                'oauth/token',
                'POST'
            );
            $response = Route::dispatch($proxy);
            $code = $response->getStatusCode();

            if ($code == 200) {
                $message = 'تم تسجيل الدخول بنجاح';
                $status = true;
            } else {
                $message = "بيانات الدخول غير صحيحة";
                $status = false;
            }

            $data= json_decode($response->content());
            $data->client = $client;

        }else{
            $message = "كود التحقق  صحيح";
            $data = [];
            $code = 200;
            $status = true;
        }
        return prepareResult($status, $data, $message,$code);
    }

    /*REGISTER NEW CLIENT AND THEN SEND ACCESS TOKEN TO THE CLIENT*/
    public function registerNewClient(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits_between:5,15|exists:temp_clients|unique:clients',
            'verification_code' => 'required',
            'name' => 'required',
            'gender' => 'required|in:"male","female"',
            'dob' => 'required|date',
            'email' => 'required|email|unique:clients',
            'city_id' => 'required|exists:cities,id',
           // 'device_token' => 'required',
        ],[],[
            'mobile' => 'رقم الجوال',
            'verification_code' => 'كود التحقق',
            'name' => 'الاسم',
            'email' => 'البريد الالكتروني',
            'city_id' => 'المدينة',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $temp_client=TempClient::where('mobile',$request->mobile)->first();
        if($temp_client->verification_code != $request->verification_code){
            $message = "كود التحقق غير صحيح";
            $data = [];
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $client= new Client();
        $client->mobile =$request->mobile;
        $client->email =$request->email;
        $client->city_id =$request->city_id;
        $client->name =$request->name;
        $client->gender =$request->gender;
        $client->dob =Carbon::parse($request->dob);
        $client->device_token =$request->device_token;
        $client->password =Hash::make($request->verification_code);
        $client->save();

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->mobile,
            'password' => $request->verification_code,
            'scope' => null,
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );
        $response = Route::dispatch($proxy);
        $code = $response->getStatusCode();

        if ($code == 200) {
            $message = 'تم تسجيل الدخول بنجاح';
            $status = true;
        } else {
            $message = "بيانات الدخول غير صحيحة";
            $status = false;
        }

        $data = json_decode($response->content());
        $data->client = $client;

        return prepareResult($status, $data, $message,$code);
    }

    /*GET ALL CITIES FOR REGISTER CLIENT*/
    public function getCities(){

        $data = Cities::orderBy('name', 'asc')->get()->map(function ($m) {
            return [
                'id' => $m->id,
                'name' => $m->name,
            ];
        });

        $message = "تمت العملية بنجاح";
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);


    }

    public function refresh_token(Request $request){
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required'
        ]);

        if ($validator->fails()) {
                $message = "تأكد من البيانات المدخلة";
                $data = $validator->errors();
                $code = 422;
                $status = false;
                return prepareResult($status, $data, $message,$code);
           }

        $request->request->add([
            'grant_type' => 'refresh_token',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'refresh_token' => $request->refresh_token,
            'scope' => null,
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );
        $response = Route::dispatch($proxy);
        $code = $response->getStatusCode();
        if ($code == 200) {
            $message = 'تم تسجيل الدخول بنجاح';
            $status = true;
        } else {
            $message = "بيانات الدخول غير صحيحة";
            $status = false;
        }
        $data = json_decode($response->content());
        return prepareResult($status, $data, $message,$code);
    }


    public function getProfile(Request $request){
        $message = "تمت العملية بنجاح";
        $data = $request->user();
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    /*UPDATE CLIENT PROFILE*/
    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'name' =>  'required',
            'email' => 'required|email',
            'gender' => 'required|in:"male","female"',   //male ,female
            'dob' => 'required|date',
            'city_id' => 'required|exists:cities,id',
//            'profile_img' =>  'required',

        ],[],[
            'name' => 'الاسم',
            'email' => 'البريد الالكتروني',
            'gender' => 'الجنس',
            'dob' => 'تاريخ الميلاد',
            'city_id' => 'المدينة',
//            'profile_img' => 'الصورة الشخصية',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $user=Client::where('id',$request->id)->first();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->gender=$request->gender;
        $user->dob=Carbon::parse($request->dob)->format('Y-m-d');
        $user->city_id=$request->city_id;
//        $user->profile_img=$request->profile_img;
        $user->save();

        $message = "تمت العملية بنجاح";
        $data = [
            'user'=>$user
        ];

        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }


    public function getAddresses(Request $request){
        $addresses=AddressesBook::where('client_id',$request->client_id)
            ->get();
        $message = "تمت العملية بنجاح";
        $data = $addresses;
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }
    public function addClientAddress(Request $request){

        $validator = Validator::make($request->all(), [
            'location' => array('required', 'regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/'), //regex
            'title' => 'required',
//            'notes' => 'required',
        ],[],[
            'location' => ' الموقع',
            'title' => 'الاسم',

        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }
//        $user=$request->user();
        //return $user;

        $location = explode(',', $request->location);

        $address=new AddressesBook();
//        $address->client_id= $user->id;
        $address->client_id= $request->client_id;
        $address->location_lat= $location[0];
        $address->location_long= $location[1];
        $address->title= $request->title;
        $address->notes= $request->notes;
        $address->save();

        $message = "تمت العملية بنجاح";
        $data = [];
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    public function deleteClientAddress(Request $request,AddressesBook $address){
//        $user=$request->user();

        if($address->client_id == $request->client_id){
            $address->delete();
            $message = "تمت العملية بنجاح";
            $data = [];
            $code = 200;
            $status = true;
            return prepareResult($status, $data, $message,$code);
        }else{
            $message = "تأكد من البيانات المدخلة";
            $data = [];
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }
    }

    public function checkPromoCode(Request $request){
        $promo_code_uses_count=null;
        $promo_code_per_client=null;
        $promocode= Coupon::where('code',$request->promo_code)->first();
        if($promocode){
            $promo_code_uses_count=CouponsUse::where('coupon_id',$promocode->id)->count();
            $promo_code_per_client=CouponsUse::where('coupon_id',$promocode->id)->where('client_id',$request->client_id)->count();
            if($promocode->end_at>=date('Y-m-d H:i:s')
                &&$promocode->start_at<=date('Y-m-d H:i:s')
                &&$promocode->is_active==1
                &&$promocode->max_use>$promo_code_uses_count
                &&$promocode->max_use_per_user>$promo_code_per_client ){
                $message = "تمت العملية بنجاح";
                $data = [$request->all(),$promocode];
                $code = 200;
                $status = true;
                return prepareResult($status, $data, $message,$code);
            }
        }
        $message = "تأكد من البيانات المدخلة";
        $data = [$request->all(),$promocode];
        $code = 422;
        $status = false;
        return prepareResult($status, $data, $message,$code);

    }
    public function getCost(Request $request){
            $str=$request->from_distance;
            $arr = preg_split('/(?<=[0-9,.])(?=[a-z, ]+)/i',$str);
            $distance= $arr[0];
            $unit= $arr[1];
            if($unit == ' م' ){
                $distance= $distance/1000;
            }else{
                $distance=$distance;
            }

        $taxi_factor=null;
        $sett=Setting::first();
        $taxi_kilometer_price=$sett->taxi_kilometer_price;
        if($request->car_type=='normal_car'){
            $taxi_factor=0;
        }elseif ($request->car_type=='family_car'){
            $taxi_factor=$sett->taxi_family_car_factor;

        }else{
            $taxi_factor=$sett->taxi_fancy_car_factor;

        }

        $price=($taxi_kilometer_price*$distance)+($taxi_factor*$taxi_kilometer_price);
        $message = "تمت العملية بنجاح";
        $data = $price;
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }



}
