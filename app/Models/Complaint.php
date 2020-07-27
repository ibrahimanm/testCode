<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $appends =['type','image_array'];

    public function user()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->morphTo();
    }

    public function reason(){
        return $this->belongsTo(ComplaintReason::class,'reason_id');
    }

    public function getTypeAttribute()
    {
        if($this->user_type == Driver::class){
                return 'سائق';

        }elseif($this->user_type == Delegate::class){
            return 'مندوب';
        }else
            return 'عميل';
    }


    public function getImageArrayAttribute(){
        $arr=[];
        if($this->photos){
            $arr=json_decode($this->photos);
        }

        return $arr;
    }
}
