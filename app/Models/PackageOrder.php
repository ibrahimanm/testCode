<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageOrder extends Model
{
    protected $table='package_orders';
    protected $guarded = [];
    protected $appends=['package_images_array', 'images_decoded'];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function delegate(){
        return $this->belongsTo(Delegate::class,'user_id');
    }

    public function offers(){
        return $this->hasMany(DeliveryOffer::class,'order_id');
    }

    public function rating()
    {
        return $this->morphMany(Rating::class, 'order');
    }

    public function complaint()
    {
        return $this->morphMany(Complaint::class, 'order');
    }

    public function getImagesDecodedAttribute()
    {
        if($this->images) {
            return array_map(function ($img) {
                return url($img);
            }, json_decode($this->images));
        }
        else
            return [];
    }

    public function getPackageImagesArrayAttribute(){
        $arr=[];
        if($this->images){
            $arr=json_decode($this->images);
        }

        return $arr;
    }

    //return max price
    public function getMaxPriceAttribute(){
        return getMaxPriceOfPackageDelivery($this);
    }

}
