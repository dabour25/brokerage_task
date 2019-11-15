<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    protected $fillable = [
        'type', 'phone_no', 'details','slug','customer_id','user_id',
    ];
}
