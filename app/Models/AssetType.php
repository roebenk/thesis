<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{

	protected $table = 'assettypes';

    public function assets() {
        return $this->hasMany('App\Models\Asset');
    }

}