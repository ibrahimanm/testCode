<?php
/**
 * Created by PhpStorm.
 * User: ibrnm
 * Date: 11/11/2018
 * Time: 9:20 AM
 */
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Client extends  Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $table='clients';
    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];
    protected $appends = ['rate'];

    public function findForPassport($username) {
        return $this->where('mobile', $username)->first();
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

    public function city(){
        return $this->belongsTo(Cities::class,'city_id');
    }

    public function taxiOrders(){
        return $this->hasMany(TaxiOrder::class,'client_id');
    }

    public function PackageOrders(){
        return $this->hasMany(PackageOrder::class,'client_id');
    }

    public function completedPackageOrders(){
        return $this->hasMany(PackageOrder::class,'client_id')
            ->where('status','reception_confirm');
    }

    public function canceledPackageOrders(){
        return $this->hasMany(PackageOrder::class,'client_id')
            ->where('status','canceled');
    }

    public function completedTaxiOrders(){
        return $this->hasMany(TaxiOrder::class,'client_id')
            ->where('status','reception_confirm');
    }

    public function canceledTaxiOrders(){
        return $this->hasMany(TaxiOrder::class,'client_id')
            ->where('status','canceled');
    }

}