<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

	public function assettype() {
        return $this->belongsTo('App\Models\AssetType');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }

}