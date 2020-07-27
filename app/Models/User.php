<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends =['user_type','vehicle_images_array','lang_array'];

    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

    public function getUserTypeAttribute()
    {
        if($this->type == 'driver'){
            return 'سائق';

        }elseif($this->type == 'delegate'){
            return 'مندوب';
        }else
            return '';
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








}
