<?php


Route::group(['namespace' => 'LaravelCreative\JqueryActions\Controllers','prefix'=>'laravel-creative','as'=>'JA:','middleware' => ['web']], function()
{

     Route::post('jquery-actions/{hashedKey}/{secondKey}/{onetime?}', ['uses' => 'JqueryActionController@fetch'])->name('fetch');
});
