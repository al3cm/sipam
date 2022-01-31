<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/processes/fill-customer/{id}','AdminProcessesController@getFillCustomer')->name('fill-customer');
Route::get('admin/processes/fill-order/{id}','AdminProcessesController@getFillOrder')->name('fill-order');
Route::get('admin/processes/fill-order-details/{id}','AdminProcessesController@getFillOrderDetails')->name('fill-order-details');


Route::post('admin/resources/edit/list-supply-details/{id}','AdminResourcesController@getSupplyDetails')->name('list-supply-details');
Route::post('admin/resources/edit/add-supply-detail','AdminResourcesController@addSupplyDetail')->name('add-supply-detail');
Route::post('admin/resources/edit/edit-supply-detail','AdminResourcesController@editSupplyDetail')->name('edit-supply-detail');
Route::post('admin/resources/edit/delete-supply-detail','AdminResourcesController@deleteSupplyDetail')->name('delete-supply-detail');


