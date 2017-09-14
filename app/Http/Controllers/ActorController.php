<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Actor;

class ActorController extends Controller {

    public function create() {
        $data['method'] = 'post';
        $data['actor'] = new Actor;
        return view('actor.new', $data);
    }

    public function store(Request $request) {
        $actor = new Actor;

        $actor->name = $request->get('name');
        $actor->actortype_id = $request->get('actortype_id');
        $actor->assessment_id = $request->get('assessment_id');
        $actor->save();

        return redirect('assessment/' . $actor->assessment_id . '/edit');

    }

    public function update($id, Request $request) {
        $actor = Actor::findOrFail($id);

        $actor->name = $request->get('name');
        $actor->actortype_id = $request->get('actortype_id');
        $actor->assessment_id = $request->get('assessment_id');
        $actor->save();

        return redirect('assessment/' . $actor->assessment_id . '/edit');

    }

    public function edit($id, Request $request) {
        $data['method'] = 'put';

        $actor = Actor::findOrFail($id);

        $data['actor'] = $actor;

        return view('actor.new', $data);
    }

    public function destroy($id) {
        $actor = Actor::findOrFail($id);

        $id = $actor->assessment_id;

        $actor->delete();

        return redirect('assessment/' . $id . '/edit');
    }

}
