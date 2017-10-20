<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Actor;
use App\Models\ActorType;

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


        if($request->has('usergroup') && is_array($request->get('usergroup'))) {
            
            foreach($request->get('usergroup') as $usergroup) {
                if(!is_null($usergroup)) {
                    $actor = new Actor;
                    $at = ActorType::firstOrFail();

                    $actor->name = $usergroup;
                    $actor->actortype_id = $at->id;
                    $actor->assessment_id = $a->id;
                    $actor->save();
                }
            }

        }

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

        // Calculate Actors
        $assessment->calculateActors();

        // Calculate Devices
        $assessment->calculateDevices();

        $data['devicesP'] = $devicesP = $assessment->devices->keyBy('id');
        $data['actorsP'] = $actorsP = $assessment->actors->keyBy('id');

        // Rank devices and actors
        $ranking = [];
        foreach($devicesP as $device) {
            $ranking['d' . $device->id] = $device->probability;
        }

        foreach($actorsP as $actor) {
            $ranking['a' . $actor->id] = $actor->probability;
        }

        arsort($ranking);
        $data['ranking'] = $ranking;

        // Calculate assets
        $data['assetRanking'] = [];
        foreach($assessment->assets as $asset) {

            $removeDuplicates = [];

            // Loop through all devices in the assessment
            foreach($asset->devices as $device) {
                $asset->addElementId('"#device-' . $device->id . '"');
                $dp = $devicesP->get($device->id);

                $asset->addEffect($dp->probability);

                // Loop through all the actors that are connected to the devices in this assessment
                foreach($device->actors as $actor) {

                    if(!in_array($actor->id, $removeDuplicates)) {

                        $asset->addElementId('"#actor-' . $actor->id . '"');
                        $ap = $actorsP->get($actor->id);

                        $asset->addEffect($ap->probability);
                        $removeDuplicates[] = $actor->id;
                    }

                }

            }

            $asset->calculateProbability();
            $asset->calculateRisk();

            $data['assets'] = $assessment->assets->keyBy('id');

            $data['assetRanking'][$asset->id] = $asset->risk;

        }

        arsort($data['assetRanking']);
        
        $data['assessment'] = $assessment;

        return view('assessment.results', $data);
    
    }

    public function destroy($id) {
        $a = Assessment::findOrFail($id);
        $a->delete();
        return redirect('assessment');
    }

}