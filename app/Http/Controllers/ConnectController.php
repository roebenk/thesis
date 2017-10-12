<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Actor;
use App\Models\Device;
use App\Models\Asset;

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

        if($values['fromType'] == 'device' && $values['toType'] == 'asset') {
            $device = Device::findOrFail($values['fromId']);
            $asset = Asset::findOrFail($values['toId']);

            $device->assets()->attach($asset->id);
            $device->save();

        }

    }

}
