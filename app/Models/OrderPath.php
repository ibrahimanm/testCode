<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPath extends Model
{
    public $timestamps = false;


    public function target()
    {
        return $this->morphTo();
    }
}
