<?php


Route::group(['namespace' => 'LaravelCreative\JqueryAction\Controllers','prefix'=>'laravel-creative','as'=>'JA:','middleware' => ['web']], function()
{

     Route::post('jquery-action/{hashedKey}/{secondKey}/{onetime?}', ['uses' => 'JqueryActionController@fetch'])->name('fetch');
});
