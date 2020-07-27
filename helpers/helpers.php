<?php


define('PER_PAGE', 15);
define('MIN_DISTANCE_TO_GET_ORDERS_FOR_DELEGATE', 100);
define('MIN_DISTANCE_TO_GET_ORDERS_FOR_DRIVER', 50);
define('CURRENCY', 'ريال');

function getTranslationsJs()
{
    $translationFile = resource_path('lang/'.app()->getLocale().'.json');

    if (! is_readable($translationFile)) {
        $translationFile = resource_path('lang/'.app('translator')->getFallback().'.json');
    }

    return ['translations' => json_decode(file_get_contents($translationFile), true)];
}
//DISTANCE BETWEEN TWO LOCATIONS
function vincentyGreatCircleDistance(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
    return ($angle * $earthRadius);
}


//Get PAth Length
function PathLength($order)
{
    $path = $order->path;
    $num = [];
    $sum=0;

    if (count($path)) {
        for ($x = 0; $x < count($path) - 1; $x++) {
            $distance = vincentyGreatCircleDistance($path[$x]['location_lat'], $path[$x]['location_long'], $path[$x + 1]['location_lat'], $path[$x + 1]['location_long']);
            array_push($num, $distance);
        }
        $sum = array_sum($num) / 1000;
    }
    return $sum;
}


 function arabic_slug ($string, $separator = '-') {
    if (is_null($string)) {
        return "";
    }

    // Remove spaces from the beginning and from the end of the string
    $string = trim($string);

    // Lower case everything
    // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
    $string = mb_strtolower($string, "UTF-8");;

    // Make alphanumeric (removes all other characters)
    // this makes the string safe especially when used as a part of a URL
    // this keeps latin characters and arabic charactrs as well
    $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

    // Remove multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);

    // Convert whitespaces and underscore to the given separator
    $string = preg_replace("/[\s_]/", $separator, $string);

    return $string;
}

function prepareResult($status, $data, $msg,$code){
    return response(['status' => $status,'data' => $data, 'message' => $msg],$code);

}

function getDayName($dayNum){
    $day_name=0;
    switch ($dayNum){
        case 0:
            return 'SUNDAY';
        case 1:
            return 'MONDAY';
        case 2:
            return 'TUESDAY';
        case 3:
            return 'WEDNESDAY';
        case 4:
            return 'THURSDAY';
        case 5:
            return 'FRIDAY';
        case 6:
            return 'SATURDAY';
    }

    return $day_name;
}


//Send Public FCM Notifications
function sendPublicNotification($tokens,$message,$ObjectId='',$ObjectType='',$data=''){

    if( is_array($tokens) &&count($tokens)) {
        $optionBuilder = new \LaravelFCM\Message\OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new \LaravelFCM\Message\PayloadNotificationBuilder('Beam');
        $notificationBuilder->setBody($message)
            ->setIcon('https://delivery.applaab.com/img/icons/mob-logo.png')
            ->setClickAction(generateNotificationLink($ObjectType, $ObjectId))
            ->setSound('default');

        $dataBuilder = new \LaravelFCM\Message\PayloadDataBuilder();
        $dataBuilder->addData(['object_type' => $ObjectType,'object_id' => $ObjectId,'data'=>$data,'created_at'=>Carbon\Carbon::now()->format('Y-m-d H:i:s')]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

// You must change it to get your tokens
        // $tokens = MYDATABASE::pluck('fcm_token')->toArray();

        $downstreamResponse = \LaravelFCM\Facades\FCM::sendTo($tokens, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
        $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

// return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();

    }
}

function generateNotificationLink($objectType, $objectId)
{
    $link = '';
    switch ($objectType) {
        case 'new_taxi_order' : $link = env('DRIVER_LINK') . '/#/?o=' . $objectId; break;
        case 'new_order' : $link = env('DELEGATE_LINK') . '/#/?o=' . $objectId; break;
        case 'accept_offer' :
        case 'reception_confirmed' : $link = env('DELEGATE_LINK') . '/#/order-details/' . $objectId; break;
    }

    return $link;
}

//get nearest Delegate to send notification
function nearestDelegates($lat, $lng, $radius = 100, $unit = "km")
{
    $unit = ($unit === "km") ? 6378.10 : 3963.17;
    $lat = (float) $lat;
    $lng = (float) $lng;
    $radius = (double) $radius;
    return \App\Models\Delegate::where('active',1)
        ->where('is_working',1)
        ->where('is_busy',0)
        ->select(\DB::raw("*,
                            ROUND(($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(location_lat))
                                * COS(RADIANS($lng) - RADIANS(location_long))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(location_lat)))),4) AS distance")

        )
        ->orderBy('distance','asc')
        ->get()
        ->where('distance', '<=', MIN_DISTANCE_TO_GET_ORDERS_FOR_DELEGATE)
        ->pluck('id')->toArray();
    //;
}


function nearestDrivers($lat, $lng,$taxi_type, $radius = 100, $unit = "km")
{
    $unit = ($unit === "km") ? 6378.10 : 3963.17;
    $lat = (float) $lat;
    $lng = (float) $lng;
    $radius = (double) $radius;
    return \App\Models\Driver::where('active',1)
        ->where('is_working',1)
        ->where('is_busy',0)
        ->where('taxi_type',$taxi_type)
        ->select(\DB::raw("*,
                            ROUND(($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(location_lat))
                                * COS(RADIANS($lng) - RADIANS(location_long))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(location_lat)))),4) AS distance")

        )
        ->orderBy('distance','asc')
        ->get()
        ->where('distance', '<=', MIN_DISTANCE_TO_GET_ORDERS_FOR_DRIVER)
        ->pluck('id')
      ->toArray();
    //;
}

//RETURN THE MAX PRICE THAT DELEGATE CAN MAKE OFFER WITH.
function getMaxPriceOfPackageDelivery($order){
    $distance_km=vincentyGreatCircleDistance($order->source_lat,$order->source_long,$order->destination_lat,$order->destination_long)/1000;

    $price=\App\Models\DeliveryPrice::where('from_distance','<=',$distance_km)
            ->where('to_distance','>=',$distance_km)
            ->first();
    if($price){
        return $price->price;
    }
    else
        return 0;
}

//CLOSE THE ORDER WHEN CLIENT CONFIRM RECEPTION
function closeDeliveryOrder($order_id){
    $order=\App\Models\PackageOrder::find($order_id);
    $order->status='reception_confirmed';
    if($order->save()){
        $tokens=[$order->delegate->device_token];
        $msg='تم تأكيد الاستلام';
        $ObjectId=$order->id;
        $ObjectType='reception_confirmed';
        sendPublicNotification($tokens,$msg,$ObjectId,$ObjectType);


        ///   CHECK PROMO CODE AND CALCULATE DISCOUNT AND PRICE
        if($order->promo_code) {
            //save Promo uses
            $promocode = \App\Models\Coupon::where('code', $order->promo_code)->first();

            $promo_use = new \App\Models\CouponsUse();
            $promo_use->order_id = $order_id;
            $promo_use->order_type = \App\Models\PackageOrder::class;
            $promo_use->coupon_id = $promocode->id;
            $promo_use->client_id = $order->client_id;
            $promo_use->discount_ratio = $promocode->ratio;
            $promo_use->discount_value = ((double)$order->delivery_price) * ((double)$promocode->ratio / 100);
            $promo_use->save();

            $order->total_price=$order->delivery_price;
            $order->discount_price=$promo_use->discount_value;
            $order->subtotal_price=(double)$order->delivery_price - (double)$promo_use->discount_value;
            $order->save();
        }else{
            $order->total_price=$order->delivery_price;
            $order->discount_price=0;
            $order->subtotal_price=$order->delivery_price ;
            $order->save();
        }

        /// CREATE INVOICE FOR ORDER
        $system_ratio= getSystemRatio($order); //get system ratio

        $invoice= new \App\Models\Invoice();
        $invoice->order_type=\App\Models\PackageOrder::class;
        $invoice->order_id=$order_id;
        $invoice->delivery_price=$order->delivery_price;
        $invoice->system_ratio=$system_ratio;
        $invoice->value=(double)$order->delivery_price*((double)$system_ratio/100);
        $invoice->save();

        //Deal with delegate budget
        $delegate=\App\Models\Delegate::find($order->delegate->id);
        $delegate->is_busy=0;

        //now if there discount we add it to delegate budget && (-) system
        $delegate->budget=($delegate->budget+$order->discount_price)-$invoice->value;

        $delegate->save();

    }

}
//GET THE SYSTEM RATIO
function getSystemRatio($order){
    $ratio=0;
    $setting=\App\Models\Setting::first();

    $delegate=\App\Models\Delegate::find($order->user_id);
    $order_today_count=\App\Models\PackageOrder::where('user_id',$delegate->id)
        ->where('status','reception_confirmed')
        ->where('created_at',\Carbon\Carbon::today())
        ->count();

    $changing_ratio=\App\Models\ChangingRatio::where('from_date','<=',\Carbon\Carbon::now())
        ->where('to_date','>=',\Carbon\Carbon::now())
        ->where('more_than_in_day', '<=', $order_today_count)
        ->orderBy('more_than_in_day', 'DESC')
        ->first();

    if ($changing_ratio) {
        $ratio=$changing_ratio->ratio;
    }else{
        $ratio=	$setting->public_ratio_delivery;
    }

    return $ratio;
}

//PROMO CODE USES FORE ONE USER
function promo_code_uses_count($code,$client_id=null){
    $promocode=\App\Models\Coupon::where('code',$code)->first();
    $use_Count=0;
    if($promocode) {
        $use_Count = \App\Models\CouponsUse::where(function ($q) use ($promocode, $client_id) {
            $q->where('coupon_id', $promocode->id);

            if ($client_id) {
                $q->where('client_id', $client_id);
            }
        })->count();
    }
    return $use_Count;
}


function sendSMS($number, $msg)
{
    /*
    if($number == '0597228808') {
        return;
    }
    $curl = new \App\SMS();

    if($number[0] == "0"){
        $number = '966'.substr($number, 1, strlen($number));
    }

    $username = "shames";		// The user name of gateway
    $password = "Sh123456"; 			// the password of gateway
    $destinations = $number; // 966500000000,966510000000
    $message = $msg;
    $sender = "Beam";

    $url = "http://www.jawalbsms.ws/api.php/sendsms?user=$username&pass=$password&to=$destinations&message=$message&sender=$sender";

    $urlDiv = explode("?", $url);
    $result = $curl->_simple_call("post", $urlDiv[0], $urlDiv[1], array("TIMEOUT" => 3));
    return $result;

    exit;
    if($number[0] == "0"){
        $number = '966'.substr($number, 1, strlen($number));
    }
    $msg = convertToUnicode($msg);
    $url = "http://www.mobily.ws/api/msgSend.php?mobile=966508688071&password=sam123&numbers=$number&sender=ABKARINO&msg=$msg&applicationType=68";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return $output;*/
       $text = urlencode($msg);
        $user="966500032280";
        $pass="225588";
        $sender="CARWAHUD";
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux i686; pt-BR; rv:1.9.2.18) Gecko/20110628 Ubuntu/10.04 (lucid) Firefox/3.6.18' );
        curl_setopt( $ch, CURLOPT_URL, 'http://www.qyadat.com/sms/api/sendsms.php?username='.$user.'&password='.$pass.'&numbers='.$number.'&sender='.$sender.'&message='.$text.'&unicode=u&return=full');
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        $res= nl2br($result);
}

function convertToUnicode($message)
{
    $chrArray[0] = "،";
    $unicodeArray[0] = "060C";
    $chrArray[1] = "؛";
    $unicodeArray[1] = "061B";
    $chrArray[2] = "؟";
    $unicodeArray[2] = "061F";
    $chrArray[3] = "ء";
    $unicodeArray[3] = "0621";
    $chrArray[4] = "آ";
    $unicodeArray[4] = "0622";
    $chrArray[5] = "أ";
    $unicodeArray[5] = "0623";
    $chrArray[6] = "ؤ";
    $unicodeArray[6] = "0624";
    $chrArray[7] = "إ";
    $unicodeArray[7] = "0625";
    $chrArray[8] = "ئ";
    $unicodeArray[8] = "0626";
    $chrArray[9] = "ا";
    $unicodeArray[9] = "0627";
    $chrArray[10] = "ب";
    $unicodeArray[10] = "0628";
    $chrArray[11] = "ة";
    $unicodeArray[11] = "0629";
    $chrArray[12] = "ت";
    $unicodeArray[12] = "062A";
    $chrArray[13] = "ث";
    $unicodeArray[13] = "062B";
    $chrArray[14] = "ج";
    $unicodeArray[14] = "062C";
    $chrArray[15] = "ح";
    $unicodeArray[15] = "062D";
    $chrArray[16] = "خ";
    $unicodeArray[16] = "062E";
    $chrArray[17] = "د";
    $unicodeArray[17] = "062F";
    $chrArray[18] = "ذ";
    $unicodeArray[18] = "0630";
    $chrArray[19] = "ر";
    $unicodeArray[19] = "0631";
    $chrArray[20] = "ز";
    $unicodeArray[20] = "0632";
    $chrArray[21] = "س";
    $unicodeArray[21] = "0633";
    $chrArray[22] = "ش";
    $unicodeArray[22] = "0634";
    $chrArray[23] = "ص";
    $unicodeArray[23] = "0635";
    $chrArray[24] = "ض";
    $unicodeArray[24] = "0636";
    $chrArray[25] = "ط";
    $unicodeArray[25] = "0637";
    $chrArray[26] = "ظ";
    $unicodeArray[26] = "0638";
    $chrArray[27] = "ع";
    $unicodeArray[27] = "0639";
    $chrArray[28] = "غ";
    $unicodeArray[28] = "063A";
    $chrArray[29] = "ف";
    $unicodeArray[29] = "0641";
    $chrArray[30] = "ق";
    $unicodeArray[30] = "0642";
    $chrArray[31] = "ك";
    $unicodeArray[31] = "0643";
    $chrArray[32] = "ل";
    $unicodeArray[32] = "0644";
    $chrArray[33] = "م";
    $unicodeArray[33] = "0645";
    $chrArray[34] = "ن";
    $unicodeArray[34] = "0646";
    $chrArray[35] = "ه";
    $unicodeArray[35] = "0647";
    $chrArray[36] = "و";
    $unicodeArray[36] = "0648";
    $chrArray[37] = "ى";
    $unicodeArray[37] = "0649";
    $chrArray[38] = "ي";
    $unicodeArray[38] = "064A";
    $chrArray[39] = "ـ";
    $unicodeArray[39] = "0640";
    $chrArray[40] = "ً";
    $unicodeArray[40] = "064B";
    $chrArray[41] = "ٌ";
    $unicodeArray[41] = "064C";
    $chrArray[42] = "ٍ";
    $unicodeArray[42] = "064D";
    $chrArray[43] = "َ";
    $unicodeArray[43] = "064E";
    $chrArray[44] = "ُ";
    $unicodeArray[44] = "064F";
    $chrArray[45] = "ِ";
    $unicodeArray[45] = "0650";
    $chrArray[46] = "ّ";
    $unicodeArray[46] = "0651";
    $chrArray[47] = "ْ";
    $unicodeArray[47] = "0652";
    $chrArray[48] = "!";
    $unicodeArray[48] = "0021";
    $chrArray[49] = '"';
    $unicodeArray[49] = "0022";
    $chrArray[50] = "#";
    $unicodeArray[50] = "0023";
    $chrArray[51] = "$";
    $unicodeArray[51] = "0024";
    $chrArray[52] = "%";
    $unicodeArray[52] = "0025";
    $chrArray[53] = "&";
    $unicodeArray[53] = "0026";
    $chrArray[54] = "'";
    $unicodeArray[54] = "0027";
    $chrArray[55] = "(";
    $unicodeArray[55] = "0028";
    $chrArray[56] = ")";
    $unicodeArray[56] = "0029";
    $chrArray[57] = "*";
    $unicodeArray[57] = "002A";
    $chrArray[58] = "+";
    $unicodeArray[58] = "002B";
    $chrArray[59] = ",";
    $unicodeArray[59] = "002C";
    $chrArray[60] = "-";
    $unicodeArray[60] = "002D";
    $chrArray[61] = ".";
    $unicodeArray[61] = "002E";
    $chrArray[62] = "/";
    $unicodeArray[62] = "002F";
    $chrArray[63] = "0";
    $unicodeArray[63] = "0030";
    $chrArray[64] = "1";
    $unicodeArray[64] = "0031";
    $chrArray[65] = "2";
    $unicodeArray[65] = "0032";
    $chrArray[66] = "3";
    $unicodeArray[66] = "0033";
    $chrArray[67] = "4";
    $unicodeArray[67] = "0034";
    $chrArray[68] = "5";
    $unicodeArray[68] = "0035";
    $chrArray[69] = "6";
    $unicodeArray[69] = "0036";
    $chrArray[70] = "7";
    $unicodeArray[70] = "0037";
    $chrArray[71] = "8";
    $unicodeArray[71] = "0038";
    $chrArray[72] = "9";
    $unicodeArray[72] = "0039";
    $chrArray[73] = ":";
    $unicodeArray[73] = "003A";
    $chrArray[74] = ";";
    $unicodeArray[74] = "003B";
    $chrArray[75] = "<";
    $unicodeArray[75] = "003C";
    $chrArray[76] = "=";
    $unicodeArray[76] = "003D";
    $chrArray[77] = ">";
    $unicodeArray[77] = "003E";
    $chrArray[78] = "?";
    $unicodeArray[78] = "003F";
    $chrArray[79] = "@";
    $unicodeArray[79] = "0040";
    $chrArray[80] = "A";
    $unicodeArray[80] = "0041";
    $chrArray[81] = "B";
    $unicodeArray[81] = "0042";
    $chrArray[82] = "C";
    $unicodeArray[82] = "0043";
    $chrArray[83] = "D";
    $unicodeArray[83] = "0044";
    $chrArray[84] = "E";
    $unicodeArray[84] = "0045";
    $chrArray[85] = "F";
    $unicodeArray[85] = "0046";
    $chrArray[86] = "G";
    $unicodeArray[86] = "0047";
    $chrArray[87] = "H";
    $unicodeArray[87] = "0048";
    $chrArray[88] = "I";
    $unicodeArray[88] = "0049";
    $chrArray[89] = "J";
    $unicodeArray[89] = "004A";
    $chrArray[90] = "K";
    $unicodeArray[90] = "004B";
    $chrArray[91] = "L";
    $unicodeArray[91] = "004C";
    $chrArray[92] = "M";
    $unicodeArray[92] = "004D";
    $chrArray[93] = "N";
    $unicodeArray[93] = "004E";
    $chrArray[94] = "O";
    $unicodeArray[94] = "004F";
    $chrArray[95] = "P";
    $unicodeArray[95] = "0050";
    $chrArray[96] = "Q";
    $unicodeArray[96] = "0051";
    $chrArray[97] = "R";
    $unicodeArray[97] = "0052";
    $chrArray[98] = "S";
    $unicodeArray[98] = "0053";
    $chrArray[99] = "T";
    $unicodeArray[99] = "0054";
    $chrArray[100] = "U";
    $unicodeArray[100] = "0055";
    $chrArray[101] = "V";
    $unicodeArray[101] = "0056";
    $chrArray[102] = "W";
    $unicodeArray[102] = "0057";
    $chrArray[103] = "X";
    $unicodeArray[103] = "0058";
    $chrArray[104] = "Y";
    $unicodeArray[104] = "0059";
    $chrArray[105] = "Z";
    $unicodeArray[105] = "005A";
    $chrArray[106] = "[";
    $unicodeArray[106] = "005B";
    $char = "\ ";
    $chrArray[107] = trim($char);
    $unicodeArray[107] = "005C";
    $chrArray[108] = "]";
    $unicodeArray[108] = "005D";
    $chrArray[109] = "^";
    $unicodeArray[109] = "005E";
    $chrArray[110] = "_";
    $unicodeArray[110] = "005F";
    $chrArray[111] = "`";
    $unicodeArray[111] = "0060";
    $chrArray[112] = "a";
    $unicodeArray[112] = "0061";
    $chrArray[113] = "b";
    $unicodeArray[113] = "0062";
    $chrArray[114] = "c";
    $unicodeArray[114] = "0063";
    $chrArray[115] = "d";
    $unicodeArray[115] = "0064";
    $chrArray[116] = "e";
    $unicodeArray[116] = "0065";
    $chrArray[117] = "f";
    $unicodeArray[117] = "0066";
    $chrArray[118] = "g";
    $unicodeArray[118] = "0067";
    $chrArray[119] = "h";
    $unicodeArray[119] = "0068";
    $chrArray[120] = "i";
    $unicodeArray[120] = "0069";
    $chrArray[121] = "j";
    $unicodeArray[121] = "006A";
    $chrArray[122] = "k";
    $unicodeArray[122] = "006B";
    $chrArray[123] = "l";
    $unicodeArray[123] = "006C";
    $chrArray[124] = "m";
    $unicodeArray[124] = "006D";
    $chrArray[125] = "n";
    $unicodeArray[125] = "006E";
    $chrArray[126] = "o";
    $unicodeArray[126] = "006F";
    $chrArray[127] = "p";
    $unicodeArray[127] = "0070";
    $chrArray[128] = "q";
    $unicodeArray[128] = "0071";
    $chrArray[129] = "r";
    $unicodeArray[129] = "0072";
    $chrArray[130] = "s";
    $unicodeArray[130] = "0073";
    $chrArray[131] = "t";
    $unicodeArray[131] = "0074";
    $chrArray[132] = "u";
    $unicodeArray[132] = "0075";
    $chrArray[133] = "v";
    $unicodeArray[133] = "0076";
    $chrArray[134] = "w";
    $unicodeArray[134] = "0077";
    $chrArray[135] = "x";
    $unicodeArray[135] = "0078";
    $chrArray[136] = "y";
    $unicodeArray[136] = "0079";
    $chrArray[137] = "z";
    $unicodeArray[137] = "007A";
    $chrArray[138] = "{";
    $unicodeArray[138] = "007B";
    $chrArray[139] = "|";
    $unicodeArray[139] = "007C";
    $chrArray[140] = "}";
    $unicodeArray[140] = "007D";
    $chrArray[141] = "~";
    $unicodeArray[141] = "007E";
    $chrArray[142] = "©";
    $unicodeArray[142] = "00A9";
    $chrArray[143] = "®";
    $unicodeArray[143] = "00AE";
    $chrArray[144] = "÷";
    $unicodeArray[144] = "00F7";
    $chrArray[145] = "×";
    $unicodeArray[145] = "00F7";
    $chrArray[146] = "§";
    $unicodeArray[146] = "00A7";
    $chrArray[147] = " ";
    $unicodeArray[147] = "0020";
    $chrArray[148] = "\n";
    $unicodeArray[148] = "000D";
    $chrArray[149] = "\r";
    $unicodeArray[149] = "000A";
    $strResult = "";
    for ($i = 0; $i < strlen($message); $i++) {
        if (in_array(mb_substr($message, $i, 1, 'UTF-8'), $chrArray))
            $strResult .= $unicodeArray[array_search(mb_substr($message, $i, 1, 'UTF-8'), $chrArray)];
    }
    return $strResult;
}
