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

    public function policies() {
    	return $this->hasMany('App\Models\Policy');
    }

    public function assets() {
        return $this->hasMany('App\Models\Asset');
    }


    public function calculateActors() {
        foreach($this->actors as $actor) {

            $probability = $actor->actortype->probability;

            $actor->setProbability($probability);
            $policies = [];
            foreach($actor->policies as $policy) {
                $policies[] = $policy->policyvalue->value;
            }

            if(count($policies) > 0) {

                $i = 1;
                foreach($policies as $policy) {
                    $probability = $probability * ($policy / ($i + 1));
                }

                $actor->setProbability($probability);

            }

        }
    }

    public function calculateDevices() {
        foreach($this->devices as $device) {

            $probability = $device->devicetype->probability;
            $device->setProbability($probability);
            $policies = [];
            foreach($device->policies as $policy) {
                $policies[] = $policy->policyvalue->value;
            }

            if(count($policies) > 0) {

                $i = 1;
                foreach($policies as $policy) {
                    $probability = $probability * ($policy / ($i + 1));
                }

                $device->setProbability($probability);

            }

        }
    }

}