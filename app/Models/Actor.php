<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{

    // Breach probability
    public $probability;

    // Get the type of the component
    public function getType() {
        return 'Actor';
    }

    // Set the breach probability
    public function setProbability($p) {
        $this->probability = $p;
    }

    // Return the name that fits the probability
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

    // Return a color from red (high probabiltiy) to green (low probability)
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
    
	public function actortype() {
        return $this->belongsTo('App\Models\ActorType');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }

    public function devices() {
    	return $this->belongsToMany('App\Models\Device');
    }

    public function policies() {
    	return $this->belongsToMany('App\Models\Policy');
    }

}