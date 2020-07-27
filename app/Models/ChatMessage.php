<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public function user()
    {
        return $this->morphTo();
    }

    public function chat(){
        return $this->belongsTo(Chat::class,'chat_id');
    }
}
