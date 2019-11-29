<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
	protected $fillable = [
        'url',
    ];
    public function photosable(){
        return $this->morphTo();
    }
}
