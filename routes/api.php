<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/sendVerificationCode', 'AuthController@sendVerificationCode');
Route::post('/checkVerificationCode', 'AuthController@checkVerificationCode');
Route::post('/register', 'AuthController@registerNewClient');
Route::post('/refresh_token', 'AuthController@refresh_token');
Route::get('/cities', 'AuthController@getCities');

Route::post('/uploads', 'UploadsController@upload');

Route::post('/profile/edit', 'AuthController@updateProfile');

Route::post('/check_promo_code', 'AuthController@checkPromoCode');
Route::post('/get_cost', 'AuthController@getCost');

Route::group(['middleware' => ['auth:api']], function(){

    Route::group(['prefix' => 'addresses'], function() {
        Route::get('/', 'AuthController@getAddresses');
        Route::post('/', 'AuthController@addClientAddress');
        Route::delete('/{address}', 'AuthController@deleteClientAddress');
    });

    //Here Auth route
    Route::group(['prefix' => 'delivery_order'],function (){
        Route::get('/myPendingOrders', 'DeliveryOrdersController@pendingOrders');
        Route::get('/myFinishedOrders', 'DeliveryOrdersController@finishedOrders');
        Route::post('/acceptDelegateOffer', 'DeliveryOrdersController@acceptDelegateOffer');
        Route::post('/confirmReception', 'DeliveryOrdersController@confirmReception');
        Route::post('/sendMessageToDelegate', 'DeliveryOrdersController@sendMessageToDelegate');
        Route::get('/getOrderChat/{order_id}', 'DeliveryOrdersController@getOrderChat');
        Route::post('/updateProfile', 'AuthController@updateProfile');
        Route::get('/getProfile', 'AuthController@getProfile');
        Route::post('/rateTheDelegate', 'DeliveryOrdersController@rateTheDelegate');
        Route::post('/postComplaint', 'DeliveryOrdersController@postComplaint');


        Route::post('/', 'DeliveryOrdersController@store');
        Route::get('/{order_id}', 'DeliveryOrdersController@show');


    });


    Route::group(['prefix' => 'taxi_order'],function (){
        Route::get('/myFinishedOrders', 'TaxiOrdersController@finishedOrders');
        Route::get('/myOrders', 'TaxiOrdersController@allOrders');

        Route::post('/', 'TaxiOrdersController@store');
        Route::get('/{order_id}', 'TaxiOrdersController@show');


    });

    Route::group(['prefix' => 'google/places'], function() {
        Route::get('nearby', 'Google\PlacesController@nearby');
        Route::get('details/{id}', 'Google\PlacesController@details');
    });


    /// Client Wallet
    Route::group(['prefix' => 'wallet'], function() {
        Route::get('/', 'ClientWalletController@getFinancialRecord');
        Route::post('/', 'ClientWalletController@storePayment');
    });
});
