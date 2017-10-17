<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{

	protected $table = 'policies';

	public function policytype() {
        return $this->belongsTo('App\Models\PolicyType');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }

    public function actors() {
    	return $this->belongsToMany('App\Models\Actor');
    }

    public function devices() {
    	return $this->belongsToMany('App\Models\Device');
    }

}