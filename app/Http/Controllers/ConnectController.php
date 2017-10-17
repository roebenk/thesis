<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Actor;
use App\Models\Device;
use App\Models\Asset;
use App\Models\Policy;
use DB;


// IMPORTANT
// Permission checks need to be implemented

class ConnectController extends Controller {

    private $components = ['actor', 'device', 'asset', 'policy'];

    public function connect(Request $request) {

        $values = $request->only('fromId', 'fromType', 'toId', 'toType');

        if($values['fromType'] == $values['toType'] || !in_array($values['fromType'], $this->components) || !in_array($values['toType'], $this->components)) {
            // Cannot happen;
            exit;
        }

        if($values['fromType'] == 'actor' && $values['toType'] == 'device') {
            $actor = Actor::findOrFail($values['fromId']);
            $device = Device::findOrFail($values['toId']);

            $actor->devices()->attach($device->id);
            $actor->save();

        }

        if($values['fromType'] == 'device' && $values['toType'] == 'actor') {
            $device = Device::findOrFail($values['fromId']);
            $actor = Actor::findOrFail($values['toId']);

            $device->actors()->attach($actor->id);
            $device->save();

        }

        if($values['fromType'] == 'device' && $values['toType'] == 'asset') {
            $device = Device::findOrFail($values['fromId']);
            $asset = Asset::findOrFail($values['toId']);

            $device->assets()->attach($asset->id);
            $device->save();

        }

        if($values['fromType'] == 'policy' && $values['toType'] == 'actor') {
            $policy = Policy::findOrFail($values['fromId']);
            $actor = Actor::findOrFail($values['toId']);

            if($policy->policytype->works_on == 'actor') {

                $policy->actors()->attach($actor->id);
                $policy->save();

            }

        }

        if($values['fromType'] == 'policy' && $values['toType'] == 'device') {
            $policy = Policy::findOrFail($values['fromId']);
            $device = Device::findOrFail($values['toId']);

            if($policy->policytype->works_on == 'device') {

                $policy->devices()->attach($device->id);
                $policy->save();

            }

        }

    }

    public function removeConnection(Request $request) {

        $values = $request->only('fromId', 'fromType', 'toId', 'toType');

        if(($values['fromType'] == 'actor' && $values['toType'] == 'device')) {
            $table = 'actor_device';
            DB::table($table)->where('actor_id', $values['fromId'])->where('device_id', $values['toId'])->delete();
        }

        if(($values['fromType'] == 'device' && $values['toType'] == 'asset')) {
            $table = 'asset_device';
            DB::table($table)->where('device_id', $values['fromId'])->where('asset_id', $values['toId'])->delete();
        }

        if(($values['fromType'] == 'policy' && $values['toType'] == 'device')) {
            $table = 'device_policy';
            DB::table($table)->where('policy_id', $values['fromId'])->where('device_id', $values['toId'])->delete();
        }

        if(($values['fromType'] == 'policy' && $values['toType'] == 'actor')) {
            $table = 'actor_policy';
            DB::table($table)->where('policy_id', $values['fromId'])->where('actor_id', $values['toId'])->delete();
        }

    }

}
