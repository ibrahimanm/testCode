<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    protected $appends =['rate_user_type'];

    public function userFrom()
    {
        return $this->morphTo();
    }

    public function userTo()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->morphTo();
    }

    public function getRateUserTypeAttribute()
    {
        if($this->user_from_type == Driver::class){
            return 'driver';

        }elseif($this->user_from_type == Delegate::class){
            return 'delegate';
        }else
            return 'client';
    }
}
