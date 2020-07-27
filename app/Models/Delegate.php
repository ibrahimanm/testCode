<?php

namespace App\Models;

use App\Scopes\DelegateScope;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    protected $table='users';
    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];
    protected $appends = ['rate','vehicle_images_array','lang_array'];


    public function orders(){
        return $this->hasMany(PackageOrder::class,'user_id');
    }

    public function pendingOrders(){
        return $this->hasMany(PackageOrder::class,'user_id')
            ->whereIn('status',['confirmed','arrive_to_store','ask_order_store','receive_order_store','in_way','arrive_to_client_location','delivery_confirmed']);
    }

    public function completedOrders(){
        return $this->hasMany(PackageOrder::class,'user_id')
            ->where('status','reception_confirmed');
    }

    public function canceledOrders(){
        return $this->hasMany(PackageOrder::class,'user_id')
            ->where('status','canceled');
    }




    public function rating()
    {
        return $this->morphMany(Rating::class, 'user_to');
    }

    public function getRateAttribute()
    {
        $rate_count=$this->rating()->count();
        $rate_sum=$this->rating()->sum('rate');

        $r = ($rate_count)? $rate_sum/$rate_count : 0;

        return round($r,2);

    }

    public function getVehicleImagesArrayAttribute(){
        $arr=[];
        if($this->vehicle_images){
            $arr=json_decode($this->vehicle_images);
        }

        return $arr;
    }

    public function getLangArrayAttribute(){
        $arr=[];
        if($this->speak_languages){
            $arr=json_decode($this->speak_languages);
        }

        return $arr;
    }

    public function city(){
        return $this->belongsTo(Cities::class,'city_id');
    }
    public function bank(){
        return $this->belongsTo(Bank::class,'bank_name');
    }
    public function company(){
        return $this->belongsTo(TaxiCompany::class,'taxi_company_id');
    }
    public function style(){
        return $this->belongsTo(TaxiStyle::class,'taxi_style_id');
    }
    public function model(){
        return $this->belongsTo(TaxiModel::class,'taxi_model_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DelegateScope());
    }
}
