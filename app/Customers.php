<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [
        'customer_name', 'type', 'user_id','slug',
    ];
	public function photos(){
        return $this->morphMany('App\Photos', 'photosable');
    }
}
