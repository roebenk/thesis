<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    public $probability;

    // Get type of componenent
    public function getType() {
        return 'Device';
    }

    // Set the probability
    public function setProbability($p) {
        $this->probability = $p;
    }

    // Get name for the probability
    public function getProbabilityName() {
        if($this->probability > 0.8) {
            return 'Very high';
        } elseif($this->probability > 0.6) {
            return 'High';
        } elseif($this->probability > 0.4) {
            return 'Medium';
        } elseif($this->probability > 0.2) {
            return 'Low';
        } else {
            return 'Very low';
        }
    }

    // Get corresponding color for probability
    public function getProbabilityColor() {
        if($this->probability > 0.8) {
            return '#BF0008';
        } elseif($this->probability > 0.6) {
            return '#BE5208';
        } elseif($this->probability > 0.4) {
            return '#BEA611';
        } elseif($this->probability > 0.2) {
            return '#8ABE1A';
        } else {
            return '#47BE22';
        }
    }

	public function devicetype() {
        return $this->belongsTo('App\Models\DeviceType');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }

    public function actors() {
    	return $this->belongsToMany('App\Models\Actor');
    }

    public function assets() {
    	return $this->belongsToMany('App\Models\Asset');
    }

    public function policies() {
        return $this->belongsToMany('App\Models\Policy');
    }

}