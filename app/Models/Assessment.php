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


    // Calculate all the probabilities for the actors in this assessment
    public function calculateActors() {
        foreach($this->actors as $actor) {

            // Base probability
            $probability = $actor->actortype->probability;

            $actor->setProbability($probability);

            // Get all the policies that work on the actor
            $policies = [];
            foreach($actor->policies as $policy) {
                $policies[] = $policy->policyvalue->value;
            }

            // Check if there are policies
            if(count($policies) > 0) {

                $i = 1;
                foreach($policies as $policy) {
                    // Use Gordon-Loeb model to calculate the effect of the policy
                    $probability = $probability * (1 - $policy / ($i + 1));
                }

                // Set probability
                $actor->setProbability($probability);

            }

        }
    }

    // Calculate all the probabilities for the devices in this assessment
    public function calculateDevices() {
        foreach($this->devices as $device) {

            // Base probability
            $probability = $device->devicetype->probability;
            $device->setProbability($probability);

            // Get all the policies that work on this device
            $policies = [];
            foreach($device->policies as $policy) {
                $policies[] = $policy->policyvalue->value;
            }

            // Check if there are any policies
            if(count($policies) > 0) {

                $i = 1;
                foreach($policies as $policy) {
                    // User Gordon Loeb model to calculate the effect of the policy
                    $probability = $probability * (1 - $policy / ($i + 1));
                }

                // Set probability
                $device->setProbability($probability);

            }

        }
    }

}