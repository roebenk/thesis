<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{

	public function actortype() {
        return $this->belongsTo('App\Models\ActorType');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }

    public function devices() {
    	return $this->belongsToMany('App\Models\Device');
    }

}