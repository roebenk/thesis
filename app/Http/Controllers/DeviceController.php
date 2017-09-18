<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Device;

class DeviceController extends Controller {

    public function create() {
        $data['method'] = 'post';
        $data['device'] = new Device;
        return view('device.new', $data);
    }

    public function store(Request $request) {
        $device = new Device;

        $device->name = $request->get('name');
        $device->devicetype_id = $request->get('devicetype_id');
        $device->assessment_id = $request->get('assessment_id');
        $device->save();

        return redirect('assessment/' . $device->assessment_id . '/edit');

    }

    public function edit($id, Request $request) {
        $data['method'] = 'put';

        $device = device::findOrFail($id);

        $data['device'] = $device;

        return view('device.new', $data);
    }

    public function update($id, Request $request) {
        $device = Device::findOrFail($id);

        $device->name = $request->get('name');
        $device->devicetype_id = $request->get('devicetype_id');
        $device->assessment_id = $request->get('assessment_id');
        $device->save();

        return redirect('assessment/' . $device->assessment_id . '/edit');

    }

    public function destroy($id) {
        $device = Device::findOrFail($id);

        $id = $device->assessment_id;

        $device->delete();

        return redirect('assessment/' . $id . '/edit');
    }

}
