<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Auth;
use App\Models\Asset;

class AssetController extends Controller {

    public function create() {
        $data['method'] = 'post';
        $data['asset'] = new Asset;
        return view('asset.new', $data);
    }

    public function store(Request $request) {
        $asset = new Asset;

        $asset->name = $request->get('name');
        $asset->assettype_id = $request->get('assettype_id');
        $asset->assessment_id = $request->get('assessment_id');
        $asset->value = $request->get('value') / 5;
        $asset->save();

        return redirect('assessment/' . $asset->assessment_id . '/edit');

    }

    public function edit($id, Request $request) {
        $data['method'] = 'put';

        $asset = Asset::findOrFail($id);

        $data['asset'] = $asset;

        return view('asset.new', $data);
    }

    public function update($id, Request $request) {
        $asset = Asset::findOrFail($id);

        $asset->name = $request->get('name');
        $asset->assettype_id = $request->get('assettype_id');
        $asset->assessment_id = $request->get('assessment_id');
        $asset->value = $request->get('value') / 5;
        $asset->save();

        return redirect('assessment/' . $asset->assessment_id . '/edit');

    }

    public function destroy($id) {
        $asset = Asset::findOrFail($id);

        $id = $asset->assessment_id;

        $asset->delete();

        return redirect('assessment/' . $id . '/edit');
    }

}
