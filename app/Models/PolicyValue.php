<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyValue extends Model
{

	protected $table = 'policyvalues';

    public function policytype() {
        return $this->belongsTo('App\Models\PolicyType');
    }

}