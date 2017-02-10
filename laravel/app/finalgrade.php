<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class finalgrade extends Model
{
   protected $fillable = ['user_id','student_id', 'level', 'subject_id', 'grade','status'];

    public function subject(){
    	return $this->belongsTo('App\Subject');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
