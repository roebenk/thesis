<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorType extends Model
{

	protected $table = 'actortypes';

    public function actor() {
        return $this->hasMany('App\Models\Actor');
    }

}