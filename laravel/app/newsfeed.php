<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newsfeed extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
