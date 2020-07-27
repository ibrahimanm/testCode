<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxiOrder extends Model
{
    protected $table='taxi_orders';
    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function driver(){
        return $this->belongsTo(Driver::class,'user_id');
    }

    public function rating()
    {
        return $this->morphMany(Rating::class, 'order');
    }

    public function path()
    {
        return $this->morphMany(OrderPath::class, 'target');
    }

    public function complaint()
    {
        return $this->morphMany(Complaint::class, 'order');
    }

}
