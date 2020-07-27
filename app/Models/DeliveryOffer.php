<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOffer extends Model
{

    public function delegate(){
        return $this->belongsTo(Delegate::class,'user_id');
    }
}
