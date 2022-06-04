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

Route::post('admin/orders/edit-p-save/{id}','AdminOrdersController@editOrderP')->name('edit-p-save');

Route::get('admin/processes/fill-customer/{id}','AdminProcessesController@getFillCustomer')->name('fill-customer');
Route::get('admin/processes/fill-order/{id}','AdminProcessesController@getFillOrder')->name('fill-order');
Route::get('admin/processes/fill-order-details/{id}','AdminProcessesController@getFillOrderDetails')->name('fill-order-details');


Route::post('admin/resources/edit/list-supply-details/{id}','AdminResourcesController@getSupplyDetails')->name('list-supply-details');
Route::post('admin/resources/edit/add-supply-detail','AdminResourcesController@addSupplyDetail')->name('add-supply-detail');
Route::post('admin/resources/edit/delete-supply-detail','AdminResourcesController@deleteSupplyDetail')->name('delete-supply-detail');

Route::post('admin/resources/edit/list-tasks/{id}','AdminResourcesController@getTasks')->name('list-tasks');
Route::post('admin/resources/edit/add-task','AdminResourcesController@addTask')->name('add-task');
Route::post('admin/resources/edit/edit-task','AdminResourcesController@editTask')->name('edit-task');
Route::post('admin/resources/edit/finish-task','AdminResourcesController@finishTask')->name('finish-task');
Route::post('admin/resources/edit/delete-task','AdminResourcesController@deleteTask')->name('delete-task');

Route::post('admin/resources/edit/list-provider-details/{id}','AdminResourcesController@getProviderDetails')->name('list-provider-details');
Route::post('admin/resources/edit/add-provider-detail','AdminResourcesController@addProviderDetail')->name('add-provider-detail');
Route::post('admin/resources/edit/edit-provider-detail','AdminResourcesController@editProviderDetail')->name('edit-provider-detail');
Route::post('admin/resources/edit/delete-provider-detail','AdminResourcesController@deleteProviderDetail')->name('delete-provider-detail');

Route::post('admin/purchases/edit/get-stock/{id}','AdminPurchasesController@getStock')->name('get-stock');
Route::post('admin/purchases/edit/delete-purchase-detail','AdminPurchasesController@deletePurchaseDetail')->name('delete-purchase-detail');
Route::post('admin/purchases/edit/list-purchase-details/{id}','AdminPurchasesController@getPurchaseDetails')->name('list-purchase-details');
Route::post('admin/purchases/edit/add-purchase-detail','AdminPurchasesController@addPurchaseDetail')->name('add-purchase-detail');