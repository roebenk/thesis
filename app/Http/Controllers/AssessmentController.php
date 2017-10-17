<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;

class AssessmentController extends Controller {

    public function index() {

        $data['assessments'] = Assessment::all();

        return view('assessment.index', $data);

    }

    public function create() {
        return view('assessment.new');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $a = new Assessment();
        $a->name = $request->get('name');
        $a->user_id = Auth::user()->id;
        $a->save();

        return redirect('assessment')->with('flashmessage', ['class' => 'success', 'message' => 'Assessment succesfully created.']);

    }

    public function edit($id) {

        $assessment = Assessment::find($id);

        // This assessment does not exist
        if(!$assessment) {
            return redirect('assessment')->with('flashmessage', ['class' => 'danger', 'message' => 'This assessment does not exist.']);
        }

        // Not allowed to view this assessment
        if($assessment->user->id != Auth::user()->id) {
            return redirect('assessment')->with('flashmessage', ['class' => 'danger', 'message' => 'You do not have permission to view or edit this assessment.']);
        }

        $data['assessment'] = $assessment;


        return view('assessment.edit', $data);

    }

    public function open(Request $request) {
        var_dump($request->all());
    }

    public function results($id) {
        $assessment = Assessment::find($id);

        // This assessment does not exist
        if(!$assessment) {
            return redirect('assessment')->with('flashmessage', ['class' => 'danger', 'message' => 'This assessment does not exist.']);
        }

        // Not allowed to view this assessment
        if($assessment->user->id != Auth::user()->id) {
            return redirect('assessment')->with('flashmessage', ['class' => 'danger', 'message' => 'You do not have permission to view or edit this assessment.']);
        }


        $actors = [];

        foreach($assessment->assets as $asset) {
            $actors[$asset->id] = [];

            $removeDuplicates = [];

            foreach($asset->devices as $device) {
                foreach($device->actors as $actor) {

                    if(!in_array($actor->id, $removeDuplicates)) {
                        $actors[$asset->id][] = $actor;
                        $removeDuplicates[] = $actor->id;
                    }
                }
            }

        }

        $data['assessment'] = $assessment;

        return view('assessment.results', $data);
    
    }


}
