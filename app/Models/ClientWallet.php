<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientWallet extends Model
{

    public function order()
    {
        return $this->morphTo();
    }
}
