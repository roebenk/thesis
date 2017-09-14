<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{

	protected $table = 'devicetypes';

    public function device() {
        return $this->hasMany('App\Models\Device');
    }

}