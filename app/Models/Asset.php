<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

	public $effects = [];
	public $connectedElementsIds = [];
	public $probability = 0;
	public $risk = 0;

	public function addElementId($id) {
		$this->connectedElementsIds[] = $id;
	}

	public function addEffect($e) {
		$this->effects[] = $e;
	}

	public function calculateProbability() {

		$p = 1;

		foreach($this->effects as $e) {
			$p = $p * (1 - $e);
		}

		$this->probability = 1 - $p;

	}

	public function calculateRisk() {
		$this->risk = $this->probability * $this->value;
	}

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