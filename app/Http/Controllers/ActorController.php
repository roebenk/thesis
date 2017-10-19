<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Actor;

class ActorController extends Controller {

    // Create new assessment
    public function create() {
        $data['method'] = 'post';
        $data['actor'] = new Actor;
        return view('actor.new', $data);
    }

    /// Save that new asessment
    public function store(Request $request) {
        $actor = new Actor;

        $actor->name = $request->get('name');
        $actor->actortype_id = $request->get('actortype_id');
        $actor->assessment_id = $request->get('assessment_id');
        $actor->save();

        return redirect('assessment/' . $actor->assessment_id . '/edit');

    }

    // Edit assessment
    public function edit($id, Request $request) {
        $data['method'] = 'put';

        $actor = Actor::findOrFail($id);

        $data['actor'] = $actor;

        return view('actor.new', $data);
    }

    // Store edits to assessment
    public function update($id, Request $request) {
        $actor = Actor::findOrFail($id);

        $actor->name = $request->get('name');
        $actor->actortype_id = $request->get('actortype_id');
        $actor->assessment_id = $request->get('assessment_id');
        $actor->save();

        return redirect('assessment/' . $actor->assessment_id . '/edit');

    }

    // Delete an assessment
    public function destroy($id) {
        $actor = Actor::findOrFail($id);

        $id = $actor->assessment_id;

        $actor->delete();

        return redirect('assessment/' . $id . '/edit');
    }

}
