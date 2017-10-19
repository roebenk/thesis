<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

	// All different component probabilities working on this asset
	public $effects = [];

	// All component ids working on this asset
	public $connectedElementsIds = [];

	// Probabiltiy
	public $probability = 0;

	// Risk
	public $risk = 0;

	// Add connected component
	public function addElementId($id) {
		$this->connectedElementsIds[] = $id;
	}

	// Add the effect of a connected component
	public function addEffect($e) {
		$this->effects[] = (float) $e;
	}

	// Calculate the probability of this asset being breached
	public function calculateProbability() {
var_dump($this->effects);
		$p = 1;

		foreach($this->effects as $e) {
			$p = $p * (1 - $e);
		}

		$this->probability = 1 - $p;


		echo '<br>';

		var_dump($this->probability);

		echo '<br>';

	}

	// Risk = probability * impact
	public function calculateRisk() {
		$this->risk = $this->probability * $this->value;
	}

	// Get the name for the risk
	public function getRiskName() {
		if($this->risk > 0.8) {
			return 'Very high';
		} elseif($this->risk > 0.6) {
			return 'High';
		} elseif($this->risk > 0.4) {
			return 'Medium';
		} elseif($this->risk > 0.2) {
			return 'Low';
		} else {
			return 'Very low';
		}
	}

	// Get the color for the risk
	public function getRiskColor() {
		if($this->risk > 0.8) {
			return '#BF0008';
		} elseif($this->risk > 0.6) {
			return '#BE5208';
		} elseif($this->risk > 0.4) {
			return '#BEA611';
		} elseif($this->risk > 0.2) {
			return '#8ABE1A';
		} else {
			return '#47BE22';
		}
	}

	public function assettype() {
        return $this->belongsTo('App\Models\AssetType');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }

    public function devices() {
    	return $this->belongsToMany('App\Models\Device');
    }

}