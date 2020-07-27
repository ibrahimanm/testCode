<?php

namespace App\Http\Controllers\API;

use App\Jobs\SendDeliveryEmail;
use App\Models\ChatMessage;
use App\Models\Client;
use App\Models\Complaint;
use App\Models\Delegate;
use App\Models\DeliveryOffer;
use App\Models\PackageOrder;
use App\Models\Chat;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DeliveryOrdersController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'source_location' => array('required', 'regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/'), //regex
            'destination_location' => array('required', 'regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/'), //regex
            'type' => 'required|in:"package","store"',
            'store_information' => 'required_if:type,store',
            'store_id' => 'required_if:type,store',
            'images' => 'array',
            'deliver_duration' => 'required|numeric|min:1',
            'payment_type' => 'required|in:"cash","visa"',
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
            'type' => 'نوع الطلب',
            'store_information' => 'بيانات المتجر',
            'deliver_duration' => 'مدة التسليم ',
            'images' => 'الصور',
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

        $order=new PackageOrder();
        $order->client_id= $user->id;
        $order->code= $this->generateOrderCode();
        $order->type= $request->type;
        $order->notes= $request->notes;
        $order->store_id= $request->store_id;

        if($request->promo_code){
            $order->promo_code=$request->promo_code;
        }

        $order->store_id= $request->store_id;

        /*Source Location*/
        $source_location = explode(',', $request->source_location);
        $order->source_lat= $source_location[0];
        $order->source_long= $source_location[1];

        /*Source Location*/

        /*Destination Location*/
        $destination_location = explode(',', $request->destination_location);
        $order->destination_lat= $destination_location[0];
        $order->destination_long= $destination_location[1];

        /*Destination Location*/


        $order->deliver_duration= $request->deliver_duration;

        if($request->images)
        $order->images= json_encode($request->images);

        if ($request->type == 'store'){
            $order->store_information= $request->store_information;
        }

        if($order->save()){
            //$delegates_ids=nearestDelegates($order->source_lat,$order->source_lat);

          //  dd($delegates_ids);

//            $tokens=Delegate::whereIn('id',$delegates_ids)
            $tokens=Delegate::pluck('device_token')
                ->toArray();
            $msg='تم اضافة طلبية جديدة';
            $ObjectId=$order->id;
            $ObjectType='new_order';

            sendPublicNotification($tokens,$msg,$ObjectId,$ObjectType,$order->append('max_price'));
        }

        $message = "تمت العملية بنجاح";
        $data = [];
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);

    }


    public function show(Request $request,$order_id){

        $data=PackageOrder::where('id',$order_id)
            ->with('client','delegate','offers.delegate','rating.userFrom','rating.userTo')
            ->where('client_id',$request->user()->id)
            ->first();

        $message = "تمت العملية بنجاح";
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    public function pendingOrders(Request $request){
        $client = $request->user();

        $orders=PackageOrder::with('delegate')
            ->where('client_id',$client->id)
            ->whereIn('status',['new',
                'confirmed',
                'arrive_to_store',
                'ask_order_store',
                'receive_order_store',
                'in_way',
                'arrive_to_client_location',
                'delivery_confirmed'
                ])
            ->withCount('offers')
            ->paginate(PER_PAGE);


        $message = "تمت العملية بنجاح";
        $data = $orders;
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    public function finishedOrders(Request $request){
        $client = $request->user();

        $orders=PackageOrder::where('client_id',$client->id)
            ->whereIn('status',['reception_confirmed','canceled','delivery_confirmed'])
            ->paginate(PER_PAGE);


        $message = "تمت العملية بنجاح";
        $data = $orders;
        $code = 200;
        $status = true;
        return prepareResult($status, $data, $message,$code);
    }

    /*ACCEPT OFFER */
    public function acceptDelegateOffer(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' =>  [
                'required',
                Rule::exists('package_orders','id')->where(function ($query) use($request) {
                    $query->where('status', 'new');
                    $query->where('client_id', $request->user()->id);
                }),
            ],

            'offer_id' =>  [
                'required',
                Rule::exists('delivery_offers','id')->where(function ($query) use($request) {
                    $query->where('status', 'new');
                    $query->where('order_id', $request->order_id);
                }),
            ],

        ],[],[
            'offer_id' => 'رقم العرض',
            'order_id' => 'رقم الطلب',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $order=PackageOrder::find($request->order_id);
        $offer=DeliveryOffer::find($request->offer_id);

        $delegate=Delegate::find($offer->user_id);
        if($delegate->is_busy){
            $message = "لا يمكن قبول هذا العرض لان المندوب مشغول حاليا";
            $data = '';
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $offer->status ='accepted';
        $offer->save();

        $order->status='confirmed';
        $order->delivery_price=$offer->delivery_cost;
        $order->deliver_duration=$offer->time;
        $order->confirmed_at=Carbon::now();
        $order->start_at=Carbon::now();
        $order->user_id=$offer->user_id;
        if($order->save()){
            $tokens=[$offer->delegate->device_token];
            $msg='تم قبول العرض الخاص بك';
            $ObjectId=$request->order_id;
            $ObjectType='accept_offer';
            sendPublicNotification($tokens,$msg,$ObjectId,$ObjectType);

            $delegate->is_busy=1;
            $delegate->save();
        }

        $status = true;
        $message = 'تمت العملية بنجاح';
        $data = [];
        $code = 200;

        return prepareResult($status, $data, $message,$code);
    }


    /*CONFIRM THE DELIVERY BY DELEGATE*/
    public function confirmReception(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' =>  [
                'required',
                Rule::exists('package_orders','id')->where(function ($query) {
                    $query->where('status', 'delivery_confirmed');
                }),
            ],

        ],[],[
            'order_id' => 'رقم الطلب',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        //close the order
       // closeDeliveryOrder($request->order_id);

        $order=\App\Models\PackageOrder::find($request->order_id);
        $order->status='reception_confirmed';
        if($order->save()) {
            $tokens = [$order->delegate->device_token];
            $msg = 'تم تأكيد الاستلام';
            $ObjectId = $order->id;
            $ObjectType = 'reception_confirmed';
            sendPublicNotification($tokens, $msg, $ObjectId, $ObjectType);
        }
        //SendDeliveryEmail::dispatch($order);

        $status = true;
        $message = 'تمت العملية بنجاح';
        $data = [
            'order' => $order=\App\Models\PackageOrder::find($request->order_id)
        ];
        $code = 200;

        return prepareResult($status, $data, $message,$code);

    }


    /*RATE THE CLIENT AFTER THE ORDER FINISHED*/
    public function rateTheDelegate(Request $request){
        $validator = Validator::make($request->all(), [
            'rate' => 'required|numeric|between:1,5',
            // 'comment' => 'required',
            'order_id' =>  [
                'required',
                Rule::exists('package_orders','id')->where(function ($query) use($request) {
                    $query->whereIn('status', ['reception_confirmed','delivery_confirmed']);
                    $query->where('client_id', $request->user()->id);
                }),
                Rule::unique('ratings','order_id')->where(function ($query) use($request){
                    $query->where('order_type', PackageOrder::class);
                    $query->where('user_from_type', Client::class);
                    $query->where('user_from_id', $request->user()->id);
                })
            ],

        ],[],[
            'order_id' => 'رقم الطلب',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }


        $order=PackageOrder::find($request->order_id);

        $rating=new Rating();
        $rating->user_from_type=Client::class;
        $rating->user_from_id=$request->user()->id;
        $rating->user_to_type=Delegate::class;
        $rating->user_to_id=$order->user_id;
        $rating->order_type=PackageOrder::class;
        $rating->order_id=$order->id;
        $rating->rate=$request->rate;
        $rating->comment=$request->comment;
        $rating->save();

        $status = true;
        $message = 'تمت العملية بنجاح';
        $data = [];
        $code = 200;

        return prepareResult($status, $data, $message,$code);

    }

    /*POST COMPLAINT */
    public function postComplaint(Request $request){
        $validator = Validator::make($request->all(), [
            'reason_id' => 'required|numeric',
            // 'text' => 'required',
            'photos' => 'array',
            'order_id' =>  [
                'required',
                Rule::exists('package_orders','id')->where(function ($query) use($request) {
                    // $query->where('status', 'reception_confirm');
                    $query->where('client_id', $request->user()->id);
                }),
                Rule::unique('complaints','order_id')->where(function ($query) use($request){
                    $query->where('order_type', PackageOrder::class);
                    $query->where('user_type', Client::class);
                    $query->where('user_id', $request->user()->id);
                })
            ],

        ],[],[
            'order_id' => 'رقم الطلب',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }


        $order=PackageOrder::find($request->order_id);

        $complaint=new Complaint();
        $complaint->user_type=Client::class;
        $complaint->user_id=$request->user()->id;
        $complaint->order_type=PackageOrder::class;
        $complaint->order_id=$order->id;
        $complaint->status='new';
        $complaint->text=$request->text;
        $complaint->reason_id=$request->reason_id;

        if($request->photos){
            $complaint->photos=json_encode($request->photos);
        }

        $complaint->save();

        $status = true;
        $message = 'تمت العملية بنجاح';
        $data = [];
        $code = 200;

        return prepareResult($status, $data, $message,$code);
    }


    /*SEND MESSAGE TO DELEGATE*/
    public function sendMessageToDelegate(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' =>  [
                'required',
                Rule::exists('package_orders','id')->where(function ($query) {
                    $query->whereNotIn('status', ['reception_confirmed','canceled']);
                }),
            ],
            'text'=> 'required',

        ],[],[
            'order_id' => 'رقم الطلب',
        ]);
        if ($validator->fails()) {
            $message = "تأكد من البيانات المدخلة";
            $data = $validator->errors();
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $chat=Chat::where('order_id',$request->order_id)
            ->where('order_type',PackageOrder::class)
            ->first();
        if(!$chat){
            $chat= new Chat();
            $chat->order_id=$request->order_id;
            $chat->order_type=PackageOrder::class;
            $chat->save();
        }

        $chat_msg= new ChatMessage();
        $chat_msg->chat_id=$chat->id;
        $chat_msg->text=$request->text;
        $chat_msg->user_id=$request->user()->id;
        $chat_msg->user_type=Client::class;
        $chat_msg->save();

        $status = true;
        $message = 'تمت العملية بنجاح';
        $data = [];
        $code = 200;

        return prepareResult($status, $data, $message,$code);

    }

    /*Get order Chat*/
    public function getOrderChat(Request $request,$order_id){
        $user=$request->user();
        $order=PackageOrder::find($order_id);
        if(!$order || $order->client_id != $user->id){
            $message = "تأكد من البيانات المدخلة";
            $data = '';
            $code = 422;
            $status = false;
            return prepareResult($status, $data, $message,$code);
        }

        $chat=Chat::where('order_id',$order_id)
            ->with('messages.user')
            ->where('order_type',PackageOrder::class)
            ->first();

        $status = true;
        $message = 'تمت العملية بنجاح';
        $data = $chat;
        $code = 200;

        return prepareResult($status, $data, $message,$code);
    }

    ///Helper
    function generateOrderCode(){
        $token=rand(1000000,9999999);
        $code_g=$token;
        $act_link = PackageOrder::where('code',$code_g)->count();
        while ($act_link)
        {
            $token=rand(10000,99999);
            $code_g=$token;
            $act_link = PackageOrder::where('code',$code_g)->count();
        }

        return $code_g;
    }
}
