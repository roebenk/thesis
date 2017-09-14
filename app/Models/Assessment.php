<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function devices() {
    	return $this->hasMany('App\Models\Device');
    }

    public function actors() {
    	return $this->hasMany('App\Models\Actor');
    }


}