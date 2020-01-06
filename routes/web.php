<?php

Route::post('ajaxDelete','TesteController@ajaxDelete')->name('ajaxDelete');
Route::post('ajaxPut','TesteController@ajaxPut')->name('ajaxPut');
Route::post('ajaxPost','TesteController@ajax')->name('ajaxPost');
Route::get('ajax','TesteController@ajax')->name('ajax');
Route::get('teste','TesteController@teste');

Route::get('/', function () {
    return view('welcome');
});
