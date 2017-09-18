<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

	public function devicetype() {
        return $this->belongsTo('App\Models\DeviceType');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }

    public function actors() {
    	return $this->belongsToMany('App\Models\Actor');
    }

}