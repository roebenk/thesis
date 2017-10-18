<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\PolicyType;

class PolicyTypeController extends Controller {

    public function index() {
        $data['policytypes'] = PolicyType::all();
        return view('policytype.index', $data);
    }

    public function edit($id) {
        $data['policytype'] = PolicyType::findOrFail($id);

        return view('policytype.edit', $data);
    }

}
