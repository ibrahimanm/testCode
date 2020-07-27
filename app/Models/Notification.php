<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $appends =['type'];

    public function userTo()
    {
        return $this->morphTo();
    }

    public function getTypeAttribute()
    {
        if($this->user_to_type == Driver::class){
            return 'سائق';

        }elseif($this->user_to_type == Delegate::class){
            return 'مندوب';
        }else
            return 'عميل';
    }
}
