<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Bank;
use App\Models\ChangingRatio;
use App\Models\Complaint;
use App\Models\Coupon;
use App\Models\DeliveryPrice;
use App\Models\Setting;
use App\Models\TaxiCompany;
use App\Models\TaxiModel;
use  App\Models\TaxiPeakTime;
use  App\Models\TaxiSpecialDays;
use App\Models\TaxiStyle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $settings=Setting::first();
        return view('dashboard.settings.settings',compact('settings'));
    }

    public function saveRatio(Request $request){
        $this->validate($request, [
            'changing_ratio.*.more_than_days'      => 'required|numeric|min:0',
            'changing_ratio.*.ratio'      => 'required|numeric|max:100|min:0',
            'changing_ratio.*.from_date'      => 'required',
            'changing_ratio.*.to_date'      => 'required|after:changing_ratio.*.from_date',
            'public_ratio_delivery'      => 'required|numeric|max:100|min:0',
            'public_ratio_taxi'      => 'required|numeric|max:100|min:0',
            'max_delivery_distance'  => 'required|numeric|min:0',
            'max_taxi_distance'  => 'required|numeric|min:0',
        ], [], [
            'changing_ratio'      => 'النسبة المتغيرة ',
            'public_ratio_delivery'      => 'النسبة العامةللتوصيل ',
            'public_ratio_taxi'      => 'النسبة العامة للتاكسي ',
            'max_delivery_distance'      => ' أقصى مسافة للتوصيل ',
            'max_taxi_distance'      => ' أقصى مسافة للتاكسي ',
            'changing_ratio.*.more_than_days'      => 'عدد التوصيلات',
            'changing_ratio.*.ratio'      => 'نسبة الخصم',
            'changing_ratio.*.from_date'      => 'البداية',
            'changing_ratio.*.to_date'      => 'النهاية',

        ]);

        $setting=Setting::first();
        if($setting){
            $setting->public_ratio_delivery=$request->public_ratio_delivery;
            $setting->public_ratio_taxi=$request->public_ratio_taxi;
            $setting->max_delivery_distance=$request->max_delivery_distance;
            $setting->max_taxi_distance=$request->max_taxi_distance;
            $setting->save();
        }else{
            $setting= new Setting();
            $setting->public_ratio_delivery=$request->public_ratio_delivery;
            $setting->public_ratio_taxi=$request->public_ratio_taxi;
            $setting->max_delivery_distance=$request->max_delivery_distance;
            $setting->max_taxi_distance=$request->max_taxi_distance;
            $setting->save();
        }
        foreach (collect($request->changing_ratio) as $ratio){
            $old=ChangingRatio::where('more_than_in_day',$ratio['more_than_days'])
                ->where('ratio',$ratio['ratio'])
                ->where('from_date',Carbon::parse($ratio['from_date'])->format('Y-m-d'))
                ->where('to_date',Carbon::parse($ratio['to_date'])->format('Y-m-d'))->get();

            if($ratio['id']==0) {
                $new_r = new ChangingRatio();
                $new_r->more_than_in_day = $ratio['more_than_days'];
                $new_r->ratio = $ratio['ratio'];
                $new_r->from_date = Carbon::parse($ratio['from_date']);
                $new_r->to_date = Carbon::parse($ratio['to_date']);
                $new_r->save();
            }else {
                $new_r = ChangingRatio::find($ratio['id']);
                if ($new_r){
                    $new_r->more_than_in_day = $ratio['more_than_days'];
                    $new_r->ratio = $ratio['ratio'];
                    $new_r->from_date = Carbon::parse($ratio['from_date']);
                    $new_r->to_date = Carbon::parse($ratio['to_date']);
                    $new_r->save();
                }
            }

        }
        $message = 'تم الحفظ بنجاح';

        return response()->json(compact('message'));
    }

    public function getRatio(){
        $setting=Setting::first();

        $ratio=ChangingRatio::get()->map(function ($q){
            return[
                'id'=> $q->id,
                'more_than_days'=> $q->more_than_in_day,
                'ratio'=> $q->ratio,
                'from_date'=> $q->from_date,
                'to_date'=> $q->to_date,
                'disable'=> true,
            ];
        });

        if(!count($ratio)){
            $ratio=array([
                'id'=> 0,
                'more_than_days'=> null,
                'ratio'=>0,
                'from_date'=> null,
                'to_date'=> null,
                'disable'=> false
            ]
            );
        }

        return response(compact('ratio','setting'));
    }

    public function dellRatio($id){
        $rat=ChangingRatio::findOrFail($id);
        $rat->delete();
        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }

    public function getPromocodes(){
        $promocodes =  new Coupon();

        if(request()->has('filter')) {
            $filter = request('filter');
            $promocodes = $promocodes->where(function($query) use($filter){
                 $query->where('code', 'LIKE', "%$filter%");
                //  ->orWhere('email', 'LIKE', "%$filter%")
                //  ->orWhere('mobile', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $promocodes = $promocodes->orderBy($fieldName, $order);
        }

        $promocodes = $promocodes->paginate(10);

        return response()->json(compact('promocodes'));
    }

    public function storePromocodes(Request $request){
        $this->validate($request, [
            'code'  => 'required|unique:coupons',
            'ratio'  => 'required|numeric|min:0',
            'max_use'  => 'required|numeric|min:0',
            'max_use_per_user'  => 'required|numeric|min:0',
            'start_at'  => 'required|date',
            'end_at'  => 'required|date',
        ], [], [
            'code'      => 'معرف الكود ',
            'ratio'      => 'النسبة  ',
            'max_use'      => 'عدد الاستعمالات ',
            'max_use_per_user'      => 'عدد الاستعمالات/ عميل',
            'start_at'      => 'تاريخ البداية',
            'end_at'      => 'تاريخ النهاية ',
        ]);

        $promo=new Coupon();
        $promo->code=$request->code;
        $promo->is_active=1;
        $promo->ratio=$request->ratio;
        $promo->max_use=$request->max_use;
        $promo->max_use_per_user=$request->max_use_per_user;
        $promo->start_at=Carbon::parse($request->start_at);
        $promo->end_at=Carbon::parse($request->end_at);
        $promo->save();

        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function updatePromocodes(Request $request,$id){
        $this->validate($request, [
            'code'  => 'required|unique:coupons,code,'.$id,
            'ratio'  => 'required|numeric|min:0',
            'max_use'  => 'required|numeric|min:0',
            'max_use_per_user'  => 'required|numeric|min:0',
            'start_at'  => 'required|date',
            'end_at'  => 'required|date',
        ], [], [
            'code'      => 'معرف الكود ',
            'ratio'      => 'النسبة  ',
            'max_use'      => 'عدد الاستعمالات ',
            'max_use_per_user'      => 'عدد الاستعمالات/ عميل',
            'start_at'      => 'تاريخ البداية',
            'end_at'      => 'تاريخ النهاية ',
        ]);

        $promo=Coupon::findOrFail($id);
        $promo->code=$request->code;
        $promo->ratio=$request->ratio;
        $promo->max_use=$request->max_use;
        $promo->max_use_per_user=$request->max_use_per_user;
        $promo->start_at=Carbon::parse($request->start_at);
        $promo->end_at=Carbon::parse($request->end_at);
        $promo->save();
        return response()->json(['message' => trans('messages.saved_successfully')]);


    }

    public function getDeliveryPrices(){

        $prices =  new DeliveryPrice();

        if(request()->has('filter')) {
            $filter = request('filter');
            $prices = $prices->where(function($query) use($filter){
                $query->where('from_distance', 'LIKE', "%$filter%")
                  ->orWhere('to_distance', 'LIKE', "%$filter%")
                  ->orWhere('price', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $prices = $prices->orderBy($fieldName, $order);
        }

        $prices = $prices->paginate(10);

        return response()->json(compact('prices'));
    }

    public function storeDeliveryPrices(Request $request){
        $this->validate($request, [

            'from_distance'  => 'required|numeric|min:0|lt:to_distance',
            'to_distance'  => 'required|numeric|min:0',
            'price'  => 'required|numeric|min:0',

        ], [], [
            'from_distance'      => ' المسافة الابتدائية ',
            'to_distance'      => 'المسافة النهائية  ',
            'price'      => 'السعر',
        ]);


        $check_equal_distance_exists=DeliveryPrice::where(function ($e) use ($request){
            $e->where('from_distance',$request->from_distance);
            $e->Where('to_distance',$request->to_distance);
        })->get();
        if(count($check_equal_distance_exists)){
            return response(['message'=>'الرجاء التأكد من البيانات'],401);
        }
        // Check if from_distance  between any Two values
        $check_from_distance=DeliveryPrice::where(function ($e) use ($request){
            $e->where('from_distance','<',$request->from_distance);
            $e->Where('to_distance','>',$request->from_distance);
        })->get();
        if(count($check_from_distance)){
            return response(['message'=>'الرجاء التأكد من البيانات'],401);
        }

        // Check if to_distance  between any Two values
        $check_to_distance=DeliveryPrice::where(function ($e) use ($request){
            $e->where('from_distance','<',$request->to_distance);
            $e->Where('to_distance','>',$request->to_distance);
        })->get();
        if(count($check_to_distance)){
            return response(['message'=>'الرجاء التأكد من البيانات'],401);
        }

        ////Check if there is no values between the two distances
        $check_between_them=DeliveryPrice::where(function ($f) use ($request){
            $f->where('from_distance','>',$request->from_distance);
            $f->Where('from_distance','<',$request->to_distance);

        })->orWhere(function ($t) use ($request){
            $t->where('to_distance','>',$request->from_distance);
            $t->Where('to_distance','<',$request->to_distance);

        })->get();
        if(count($check_between_them)){
            return response(['message'=>'الرجاء التأكد من البيانات'],401);
        }

        $price=new DeliveryPrice();
        $price->from_distance=$request->from_distance;
        $price->to_distance=$request->to_distance;
        $price->price=$request->price;
        $price->save();

        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function updateDeliveryPrices(Request $request,$id){
        $this->validate($request, [
            'price'  => 'required|numeric|min:0',
        ], [], [
            'price'      => 'السعر',
        ]);
        $price=DeliveryPrice::findOrFail($id);

        $price->price=$request->price;
        $price->save();
        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function getTaxiPeakTimes(){
        $taxi_peak_times=TaxiPeakTime::get()->map(function ($q){
            return[
                'id'=> $q->id,
                'from_time'=> $q->from_time,
                'to_time'=> $q->to_time,
                'day_number'=> $q->day_number,
                'price'=> $q->price,
                'disable'=> true,
            ];
        });

        $taxi_special_days=TaxiSpecialDays::get()->map(function ($q){
            return[
                'id'=> $q->id,
                'from_date'=> $q->from_date,
                'to_date'=> $q->to_date,
                'price'=> $q->price,
                'notes'=> $q->notes,
                'disable'=> true,
            ];
        });

        if(!count($taxi_peak_times)){
            $taxi_peak_times=array([
                'id'=> 0,
                'from_time'=> null,
                'to_time'=>null,
                'day_number'=> null,
                'price'=> 0,
                'disable'=> false
            ]
            );
        }

        if(!count($taxi_special_days)){
            $taxi_special_days=array([
                'id'=> 0,
                'from_date'=> null,
                'to_date'=> null,
                'price'=> 0,
                'notes'=> null,
                'disable'=> false,
            ]
            );
        }

        return response(compact('taxi_peak_times','taxi_special_days'));
    }

    public function dellPeakTime($id){
        $rat=TaxiPeakTime::findOrFail($id);
        $rat->delete();
        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }

    public function dellSpecialDay($id){
        $rat=TaxiSpecialDays::findOrFail($id);
        $rat->delete();
        $message = 'تم الحذف بنجاح';

        return response()->json(compact('message'));
    }

    public function saveTaxiSettings(Request $request){
        $this->validate($request, [
            'taxi_peak_times.*.from_time'      => 'required',
            'taxi_peak_times.*.day_number'      => 'required|numeric|min:0',
            'taxi_peak_times.*.price'      => 'required|numeric|min:0',
            'taxi_peak_times.*.to_time'      => 'required',

            'taxi_special_days.*.from_date'      => 'required',
            //'taxi_special_days.*.notes'      => 'required',
            'taxi_special_days.*.price'      => 'required|numeric|min:0',
            'taxi_special_days.*.to_date'      => 'required|after_or_equal:taxi_special_days.*.from_date',

            'taxi_minute_price'      => 'required|numeric|min:0',
            'taxi_kilometer_price'      => 'required|numeric|min:0',
            'taxi_minimum_price'      => 'required|numeric|min:0',
            'taxi_family_car_factor'      => 'required|numeric|min:0',
            'taxi_fancy_car_factor'      => 'required|numeric|min:0',
            'taxi_max_free_waiting_minute'      => 'required|numeric|min:0',
            'taxi_waiting_minute_price'      => 'required|numeric|min:0',
            'taxi_cancellation_penalty_price'      => 'required|numeric|min:0',
            'taxi_cancellation_penalty_family_car_price'      => 'required|numeric|min:0',
            'taxi_cancellation_penalty_fancy_car_price'      => 'required|numeric|min:0',
            'taxi_max_free_minute_before_cancellation'      => 'required|numeric|min:0',
            'terms_and_conditions'      => 'required',

        ], [], [
            'taxi_special_days.*.from_date'      => 'تاريخ البداية',
            'taxi_special_days.*.price'      => 'السعر',
            'taxi_special_days.*.to_date'      => 'تاريخ النهاية',

            'taxi_peak_times.*.to_time'      => 'وقت النهاية',
            'taxi_peak_times.*.from_time'      => 'وقت البداية',
            'taxi_peak_times.*.day_number'      => 'اليوم',
            'taxi_peak_times.*.price'      => 'السعر',

            'taxi_minute_price'      => 'سعر الدقيقة',
            'taxi_kilometer_price'      => 'سعر الكيلومتر',
            'taxi_minimum_price'      => 'الحد الأدنى للسعر',
            'taxi_family_car_factor'      => 'معامل سعر السيارة العائلية',
            'taxi_fancy_car_factor'      => 'معامل سعر السيارة الفخمة',
            'taxi_max_free_waiting_minute'      => 'الحد الاقصى لدقائق الانتظار',
            'taxi_waiting_minute_price'      => 'سعر دقيقة الانتظار',
            'taxi_cancellation_penalty_price'      => 'غرامة الالغاء',
            'taxi_cancellation_penalty_family_car_price'      => 'غرامة الالغاء للسيارة العائلية',
            'taxi_cancellation_penalty_fancy_car_price'      => 'غرامة الالغاء للسيارة الفخمة',
            'taxi_max_free_minute_before_cancellation'      => 'عدد الدقائق المسموحة قبل الالغاء المجاني',
            'terms_and_conditions'      => 'الشروط والأحكام',

        ]);

        $setting=Setting::first();
        if(!$setting){
            $setting= new Setting();
        }
            $setting->taxi_minute_price=$request->taxi_minute_price;
            $setting->taxi_kilometer_price=$request->taxi_kilometer_price;
            $setting->taxi_minimum_price=$request->taxi_minimum_price;
            $setting->taxi_family_car_factor=$request->taxi_family_car_factor;
            $setting->taxi_fancy_car_factor=$request->taxi_fancy_car_factor;
            $setting->taxi_max_free_waiting_minute=$request->taxi_max_free_waiting_minute;
            $setting->taxi_waiting_minute_price=$request->taxi_waiting_minute_price;
            $setting->taxi_cancellation_penalty_price=$request->taxi_cancellation_penalty_price;
            $setting->taxi_cancellation_penalty_family_car_price=$request->taxi_cancellation_penalty_family_car_price;
            $setting->taxi_cancellation_penalty_fancy_car_price=$request->taxi_cancellation_penalty_fancy_car_price;
            $setting->taxi_max_free_minute_before_cancellation=$request->taxi_max_free_minute_before_cancellation;
            $setting->terms_and_conditions=$request->terms_and_conditions;
            $setting->save();


        foreach (collect($request->taxi_peak_times) as $time){

            if($time['id']==0) {
                $new_r = new TaxiPeakTime();
                $new_r->price = $time['price'];
                $new_r->day_number = $time['day_number'];
                $new_r->day_name = getDayName($time['day_number']);
                $new_r->from_time = Carbon::parse($time['from_time']);
                $new_r->to_time = Carbon::parse($time['to_time']);
                $new_r->save();
            }else {
                $new_r = TaxiPeakTime::find($time['id']);
                if ($new_r){
                    $new_r->price = $time['price'];
                    $new_r->day_number = $time['day_number'];
                    $new_r->from_time = Carbon::parse($time['from_time']);
                    $new_r->to_time = Carbon::parse($time['to_time']);
                    $new_r->save();
                }
            }

        }


        foreach (collect($request->taxi_special_days) as $time){

            if($time['id']==0) {
                $new_r = new TaxiSpecialDays();
                $new_r->price = $time['price'];
                $new_r->notes = $time['notes'];
                $new_r->from_date = Carbon::parse($time['from_date']);
                $new_r->to_date = Carbon::parse($time['to_date']);
                $new_r->save();
            }else {
                $new_r = TaxiSpecialDays::find($time['id']);
                if ($new_r){
                    $new_r->price = $time['price'];
                    $new_r->notes = $time['notes'];
                    $new_r->from_date = Carbon::parse($time['from_date']);
                    $new_r->to_date = Carbon::parse($time['to_date']);
                    $new_r->save();
                }
            }

        }


        $message = 'تم الحفظ بنجاح';

        return response()->json(compact('message'));
    }

    public function getTaxiCompany(){

        $taxies =  new TaxiCompany();

        if(request()->has('filter')) {
            $filter = request('filter');
            $taxies = $taxies->where(function($query) use($filter){
                $query->where('name', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $taxies = $taxies->orderBy($fieldName, $order);
        }

        $taxies = $taxies->paginate(10);

        return response()->json(compact('taxies'));
    }

    public function storeTaxiCompany(Request $request){
        $this->validate($request, [

            'name'  => 'required',

        ], [], [
            'name'      => 'الاسم',
        ]);

        $taxi=new TaxiCompany();
        $taxi->name=$request->name;
        $taxi->save();

        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function updateTaxiCompany(Request $request,$id){
        $this->validate($request, [
            'name'  => 'required',
        ], [], [
            'name'      => 'الاسم',
        ]);
        $taxi=TaxiCompany::findOrFail($id);

        $taxi->name=$request->name;
        $taxi->save();
        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function getStyleTaxiCompany(Request $request){
        $styles=TaxiStyle::where('company_id',$request->id)->get();
        return response()->json(compact('styles'));
    }
    public function storeStyle(Request $request){
        $this->validate($request, [

            'name'  => 'required',

        ], [], [
            'name'      => 'الاسم',
        ]);
        $style=new TaxiStyle();
        $style->name=$request->name;
        $style->company_id=$request->company_id;
        $style->save();

        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function updateStyle(Request $request,$id){
        $this->validate($request, [
            'name'  => 'required',
        ], [], [
            'name'      => 'الاسم',
        ]);
        $style=TaxiStyle::findOrFail($id);
        $style->name=$request->name;
        $style->company_id=$request->company_id;
        $style->save();
        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function getTaxiModel(){

        $models =  new TaxiModel();

        if(request()->has('filter')) {
            $filter = request('filter');
            $models = $models->where(function($query) use($filter){
                $query->where('name', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $models = $models->orderBy($fieldName, $order);
        }

        $models = $models->paginate(10);

        return response()->json(compact('models'));
    }

    public function storeTaxiModel(Request $request){
        $this->validate($request, [

            'name'  => 'required',

        ], [], [
            'name'      => 'الاسم',
        ]);

        $taxi=new TaxiModel();
        $taxi->name=$request->name;
        $taxi->save();

        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function updateTaxiModel(Request $request,$id){
        $this->validate($request, [
            'name'  => 'required',
        ], [], [
            'name'      => 'الاسم',
        ]);
        $taxi=TaxiModel::findOrFail($id);

        $taxi->name=$request->name;
        $taxi->save();
        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function getBank(){

        $banks =  new Bank();

        if(request()->has('filter')) {
            $filter = request('filter');
            $banks = $banks->where(function($query) use($filter){
                $query->where('name', 'LIKE', "%$filter%");
            });
        }
        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $fieldName = $sort['fieldName'] && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $banks = $banks->orderBy($fieldName, $order);
        }

        $banks = $banks->paginate(10);

        return response()->json(compact('banks'));
    }

    public function storeBank(Request $request){
        $this->validate($request, [

            'name'  => 'required',

        ], [], [
            'name'      => 'الاسم',
        ]);

        $bank=new Bank();
        $bank->name=$request->name;
        $bank->save();

        return response()->json(['message' => trans('messages.saved_successfully')]);

    }

    public function updateBank(Request $request,$id){
        $this->validate($request, [
            'name'  => 'required',
        ], [], [
            'name'      => 'الاسم',
        ]);
        $bank=Bank::findOrFail($id);

        $bank->name=$request->name;
        $bank->save();
        return response()->json(['message' => trans('messages.saved_successfully')]);

    }
}
