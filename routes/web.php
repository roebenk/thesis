<?php


Route::get('/', function () {
    return redirect('assessment');
});

Auth::routes();

Route::middleware('auth')->group(function() {
	Route::resource('assessment', 'AssessmentController');
	Route::resource('device', 'DeviceController');
	Route::resource('actor', 'ActorController');
	Route::resource('policy', 'PolicyController');
	Route::resource('asset', 'AssetController');

	Route::post('assessment-editor/open', 'AssessmentController@open');
	Route::post('assessment-editor/save', 'AssessmentController@open');

});