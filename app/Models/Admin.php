<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends  Authenticatable

{
    use Notifiable;

    protected $table='admins';
    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

}