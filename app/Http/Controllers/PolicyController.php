<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Policy;

class PolicyController extends Controller {

    public function create() {
        $data['method'] = 'post';
        $data['policy'] = new Policy;
        return view('policy.new', $data);
    }

    public function store(Request $request) {
        $policy = new Policy;

        $policy->name = $request->get('name');
        $policy->policytype_id = $request->get('policytype_id');
        $policy->assessment_id = $request->get('assessment_id');
        $policy->save();

        return redirect('assessment/' . $policy->assessment_id . '/edit');

    }

    public function edit($id, Request $request) {
        $data['method'] = 'put';

        $policy = Policy::findOrFail($id);

        $data['policy'] = $policy;

        return view('policy.new', $data);
    }

    public function update($id, Request $request) {
        $policy = Policy::findOrFail($id);

        $policy->name = $request->get('name');
        $policy->policytype_id = $request->get('policytype_id');
        $policy->assessment_id = $request->get('assessment_id');
        $policy->save();

        return redirect('assessment/' . $policy->assessment_id . '/edit');

    }

    public function destroy($id) {
        $policy = Policy::findOrFail($id);

        $id = $policy->assessment_id;

        $policy->delete();

        return redirect('assessment/' . $id . '/edit');
    }

}
