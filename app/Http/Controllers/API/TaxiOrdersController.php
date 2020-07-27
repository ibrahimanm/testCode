<?php

namespace App\Http\Controllers\API;

use App\Models\Driver;
use App\Models\TaxiOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TaxiOrdersController extends Controller
{
    /*Create new order*/
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'source_location' => array('required', 'regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/'), //regex
            'destination_location' => array('sometimes', 'regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/'), //regex
            'payment_type' => 'required|in:"cash","visa"',
           // 'notes' => 'required',
            'taxi_type' => 'required|in:"normal_car","family_car","fancy_car"',
            'promo_code' =>  [
                'sometimes',
                Rule::exists('coupons','code')->where(function ($query) use($request) {
                    $query->where('is_active', 1);
                    $query->where('start_at','<=',Carbon::now());
                    $query->where('end_at','>=',Carbon::now());
                    $query->where('max_use','>',promo_code_uses_count($request->promo_code));
                    $query->where('max_use_per_user','>',promo_code_uses_count($request->promo_code,$request->user()->id));
                }),
            ]

        ],[],[
            'source_location' => 'موقع البداية',
            'destination_location' => 'موقع التسليم',
            'payment_type' => 'نوع الدفع',
            'promo_code' => 'كود الخصم',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }
        $user=$request->user();
        //return $user;

        $order=new TaxiOrder();
        $order->client_id= $user->id;
        $order->code= $this->generateOrderCode();
        $order->notes= $request->notes;
        $order->status='new';
        $order->source_address=$request->source_address;
        $order->destination_address=$request->destination_address;

        if($request->promo_code){
            $order->promo_code=$request->promo_code;
        }
        /*Source Location*/
        $source_location = explode(',', $request->source_location);
        $order->source_lat= $source_location[0];
        $order->source_long= $source_location[1];

        /*Source Location*/

        /*Destination Location*/
        if($request->destination_location) {
            $destination_location = explode(',', $request->destination_location);
            $order->destination_lat = $destination_location[0];
            $order->destination_long = $destination_location[1];
        }
        /*Destination Location*/

        if($order->save()){
            $drivers_ids=nearestDrivers($order->source_lat,$order->source_long,$request->taxi_type);

            $tokens=Driver::whereIn('id',$drivers_ids)
                     ->pluck('device_token')
                    ->toArray();

            $msg='تم اضافة طلبية جديدة';
            $ObjectId=$order->id;
            $ObjectType='new_taxi_order';

            sendPublicNotification($tokens,$msg,$ObjectId,$ObjectType,$order);
        }

        $message = "تمت العملية بنجاح";
        $data = [
            'order' => $order
        ];
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);

    }

    /*Show one order*/
    public function show(Request $request,$order_id){

        $data=TaxiOrder::where('id',$order_id)
            ->with('client','driver','rating.userFrom','rating.userTo')
            ->where('client_id',$request->user()->id)
            ->first();

        $message = "تمت العملية بنجاح";
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    public function finishedOrders(Request $request){
        $client = $request->user();

        $orders=TaxiOrder::with('driver')
            ->where('client_id',$client->id)
            ->whereIn('status',['reception_confirm','canceled'])
            ->orderBy('id', 'desc')
            ->paginate(PER_PAGE);

        $message = "تمت العملية بنجاح";
        $data = $orders;
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    public function allOrders(Request $request){
        $client = $request->user();

        $orders=TaxiOrder::with('driver')
            ->where('client_id',$client->id)
            ->orderBy('id', 'desc')
            ->paginate(PER_PAGE);

        $message = "تمت العملية بنجاح";
        $data = $orders;
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    ///Helper
    function generateOrderCode(){
        $token=rand(1000000,9999999);
        $code_g=$token;
        $act_link = TaxiOrder::where('code',$code_g)->count();
        while ($act_link)
        {
            $token=rand(10000,99999);
            $code_g=$token;
            $act_link = TaxiOrder::where('code',$code_g)->count();
        }

        return $code_g;
    }
}
