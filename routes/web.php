<?php


Route::get('/', function () {
    return redirect('assessment');
});

Auth::routes();

Route::middleware('auth')->group(function() {
	Route::resource('assessment', 'AssessmentController');
	Route::get('assessment/{id}/results', 'AssessmentController@results');
	Route::get('assessment/{id}/delete', 'AssessmentController@destroy');
	Route::resource('device', 'DeviceController');
	Route::resource('actor', 'ActorController');
	Route::resource('policy', 'PolicyController');
	Route::resource('asset', 'AssetController');
	Route::resource('policytype', 'PolicyTypeController');

	Route::post('assessment-editor/open', 'AssessmentController@open');
	Route::post('assessment-editor/save', 'AssessmentController@open');

	Route::post('connect', 'ConnectController@connect');
	Route::post('removeConnection', 'ConnectController@removeConnection');

});