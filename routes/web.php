<?php

Route::get('/', function () {
    return redirect('dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::post('uploads', 'UploadsController@upload')->middleware('auth:web');


    Route::get('/email', function (){
       // return view('emails.delivery_invoice');

        $order=\App\Models\PackageOrder::first();
        \App\Jobs\SendDeliveryEmail::dispatch($order);

//        \Illuminate\Support\Facades\Mail::to('eng_ibrahim_anm@hotmail.com')
//            ->send(new \App\Mail\DeliveryOrderInvoice($order));
        return 'tttt';
    });

Route::get('/addPath', function (){
    // return view('emails.delivery_invoice');

    $order=\App\Models\TaxiOrder::find(5);

//    $order_path=new \App\Models\OrderPath();
//    $order_path->target_type=\App\Models\TaxiOrder::class;
//    $order_path->target_id=$order->id;
//    $order_path->time=Carbon\Carbon::now();
//    $order_path->location_lat='31.493715';
//    $order_path->location_long='34.448790';
//    $order_path->save();


    return PathLength($order);
});

Route::get('/test_notif/{del_id}', function ($del_id) {
            $del=\App\Models\Delegate::findOrFail($del_id);
            $order=\App\Models\PackageOrder::where('id','>',0)->first();
            sendPublicNotification([$del->device_token],'تم اضافة طلب جديد',$order->id,'new_order',$order);
      return 'true';
});
Route::get('/test_noti_txi/{del_id}', function ($del_id) {
    $del=\App\Models\Driver::findOrFail($del_id);
    $order=\App\Models\TaxiOrder::where('id','>',0)->first();
    sendPublicNotification([$del->device_token],'تم اضافة طلبية جديدة',$order->id,'new_taxi_order',$order);
    return 'true';
});

//Route::get('/test_max_price/{order_id}', function ($order_id) {
//    //$del=\App\Models\Delegate::findOrFail($del_id);
//    $order=\App\Models\PackageOrder::findOrFail($order_id)->append('max_price');
//    return $order;
//});

