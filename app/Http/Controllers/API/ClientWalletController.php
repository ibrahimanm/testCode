<?php

namespace App\Http\Controllers\API;

use App\Models\ClientWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientWalletController extends Controller
{
   public function getFinancialRecord(Request $request){
       $client_id=$request->user()->id;

       $data= ClientWallet::where('client_id',$client_id)
           ->with('order')
           ->get();

       $message = "تمت العملية بنجاح";
       $code = 200;
       $status = true;
       return prepareResult($status, $data, $message,$code);
   }

   // charge the wallet
   public function storePayment(Request $request){
       $validator = Validator::make($request->all(), [
           'value' => 'required|numeric|min:1',
         //  'payment_method' => 'required|numeric|min:1',
       ],[],[
           'value' => 'المبلغ',
       ]);
       if ($validator->fails()) {
           $message = "تأكد من البيانات المدخلة";
           $data = $validator->errors();
           $code = 422;
           $status = false;
           return prepareResult($status, $data, $message,$code);
       }

       $client=$request->user();

       $payment=new ClientWallet();
       $payment->client_id=$client->id;
       $payment->money=$request->value;
       $payment->process_type='deposit';
       $payment->payment_method='visa';
       if($payment->save()){
           $client->wallet=$client->wallet+$request->value;
           $client->save();
       }

       $message = "تمت العملية بنجاح";
       $data = [];
       $code = 200;
       $status = true;
       return prepareResult($status, $data, $message,$code);

   }
}
