<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyType extends Model
{

	protected $table = 'policytypes';

    public function policy() {
        return $this->hasMany('App\Models\Policy');
    }

}