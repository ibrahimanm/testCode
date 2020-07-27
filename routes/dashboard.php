<?php

Route::group([], function() {
    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});


Route::group(['middleware' => 'auth:web'], function() {

    Route::get('/', 'StatisticsController@index');
    Route::post('/uploads', 'UploadsController@upload');
});


Route::group(['prefix' => 'statistics', 'middleware' => 'auth:web'], function() {
    Route::get('/getStatistics', 'StatisticsController@getStatistics');
});


Route::group(['prefix' => 'admins', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'AdminController@index');
    Route::get('data', 'AdminController@data');
    Route::get('create', 'AdminController@create');
    Route::post('/', 'AdminController@store');
    Route::get('{admin}/edit', 'AdminController@edit');
    Route::put('{admin}', 'AdminController@update');
    Route::delete('{admin}', 'AdminController@destroy');
});

Route::group(['prefix' => 'drivers', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'DriverController@index')->name('drivers');
    Route::get('data', 'DriverController@data');
    Route::get('/{driver}', 'DriverController@show');
    Route::get('/{driver}/changeActive', 'DriverController@changeActive');
    Route::get('getOrders/{driver}', 'DriverController@orders');
    Route::get('getComments/{driver}', 'DriverController@getComments');
    Route::get('getComplaints/{driver}', 'DriverController@getComplaints');
    Route::get('getPayments/{driver}', 'DriverController@getPayments');
});

Route::group(['prefix' => 'delegates', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'DelegateController@index')->name('delegates');
    Route::get('data', 'DelegateController@data');
    Route::get('/{delegate}', 'DelegateController@show');
    Route::get('getOrders/{delegate}', 'DelegateController@orders');
    Route::get('getComments/{delegate}', 'DelegateController@getComments');
    Route::get('getComplaints/{delegate}', 'DelegateController@getComplaints');
    Route::get('getPayments/{delegate}', 'DelegateController@getPayments');
    Route::get('/{delegate}/changeActive', 'DelegateController@changeActive');

});

Route::group(['prefix' => 'clients', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'ClientsController@index');
    Route::get('data', 'ClientsController@data');
    Route::get('/{client}', 'ClientsController@show');
    Route::get('gePackageOrders/{client}', 'ClientsController@getPackageOrders');
    Route::get('geTaxiOrders/{client}', 'ClientsController@getTaxiOrders');
    Route::get('getComments/{client}', 'ClientsController@getComments');
    Route::get('getComplaints/{client}', 'ClientsController@getComplaints');
});

Route::group(['prefix' => 'confirmation_requests', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'ConfirmationRequestsController@index');
    Route::get('data', 'ConfirmationRequestsController@data');
    Route::post('/acceptRejectRequest', 'ConfirmationRequestsController@acceptRejectRequest');
    Route::get('/{req}', 'ConfirmationRequestsController@show');
});

Route::group(['prefix' => 'delivery_orders', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'DeliveryOrdersController@index');
    Route::get('data', 'DeliveryOrdersController@data');
    Route::get('/{order}', 'DeliveryOrdersController@show');
    Route::get('getComments/{order}', 'DeliveryOrdersController@getComments');
    Route::get('getComplaints/{order}', 'DeliveryOrdersController@getComplaints');

});

Route::group(['prefix' => 'taxi_orders', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'TaxiOrdersController@index');
    Route::get('data', 'TaxiOrdersController@data');
    Route::get('/{order}', 'TaxiOrdersController@show');
    Route::get('getComments/{order}', 'TaxiOrdersController@getComments');
    Route::get('getComplaints/{order}', 'TaxiOrdersController@getComplaints');
});

Route::group(['prefix' => 'complaints', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'ComplaintsController@index');
    Route::get('data', 'ComplaintsController@data');
    Route::post('/openCloseComplaint', 'ComplaintsController@openCloseComplaint');
    Route::get('/{complaint}', 'ComplaintsController@show');
});

Route::group(['prefix' => 'notifications', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'NotificationController@index');
    Route::get('data', 'NotificationController@data');
});

Route::group(['prefix' => 'payments', 'middleware' => 'auth:web'], function() {
    Route::get('/searchDrivers', 'PaymentsController@searchDrivers');
   Route::get('/searchDelegates', 'PaymentsController@searchDelegates');
    Route::get('/', 'PaymentsController@index');
    Route::get('data', 'PaymentsController@data');
    Route::get('/create', 'PaymentsController@create');
    Route::post('/', 'PaymentsController@store');
    Route::post('/confirm', 'PaymentsController@confirm');
});

Route::group(['prefix' => 'settings', 'middleware' => 'auth:web'], function() {
    Route::get('/', 'SettingsController@index');
    Route::get('data', 'SettingsController@data');
    Route::get('/getRatio', 'SettingsController@getRatio');
    Route::delete('/dellRatio/{id}', 'SettingsController@dellRatio');
    Route::post('/saveRatio', 'SettingsController@saveRatio');
    Route::get('/promocodes', 'SettingsController@getPromocodes');
    Route::post('/promocodes', 'SettingsController@storePromocodes');
    Route::put('/promocodes/{id}', 'SettingsController@updatePromocodes');
    Route::get('/delivery_prices', 'SettingsController@getDeliveryPrices');
    Route::post('/delivery_prices', 'SettingsController@storeDeliveryPrices');
    Route::put('/delivery_prices/{id}', 'SettingsController@updateDeliveryPrices');
    Route::get('/taxi_peak_times', 'SettingsController@getTaxiPeakTimes');
    Route::delete('/dellPeakTime/{id}', 'SettingsController@dellPeakTime');
    Route::delete('/dellSpecialDay/{id}', 'SettingsController@dellPeakTime');
    Route::post('/saveTaxiSettings', 'SettingsController@saveTaxiSettings');

    Route::get('/TaxiCompany', 'SettingsController@getTaxiCompany');
    Route::post('/TaxiCompany', 'SettingsController@storeTaxiCompany');
    Route::put('/TaxiCompany/{id}', 'SettingsController@updateTaxiCompany');
    Route::get('/TaxiStyle/{id}', 'SettingsController@getStyleTaxiCompany');

    Route::post('/style', 'SettingsController@storeStyle');
    Route::put('/style/{id}', 'SettingsController@updateStyle');

    Route::get('/TaxiModel', 'SettingsController@getTaxiModel');
    Route::post('/TaxiModel', 'SettingsController@storeTaxiModel');
    Route::put('/TaxiModel/{id}', 'SettingsController@updateTaxiModel');


    Route::get('/bank', 'SettingsController@getBank');
    Route::post('/bank', 'SettingsController@storeBank');
    Route::put('/bank/{id}', 'SettingsController@updateBank');

});

    Route::get('drivers_t',function (){
        $langs=['ar','en','esp'];
        $vichel=['temps/eXTSErKsqjXZ4cQDpM09CMVLR018b15NhiWKIBZQ.jpeg','temps/cvTqN99xBi18wTI5C60REI67gEqkx82DrTHyz5dQ.jpeg','temps/eXTSErKsqjXZ4cQDpM09CMVLR018b15NhiWKIBZQ.jpeg'];
        $delegate= new \App\Models\Delegate();
        $delegate->name='اسماعيل عبدالله';
        $delegate->mobile='3334445556';
        $delegate->email='soma@vc.com';
        $delegate->type='delegate';
        $delegate->gender='male';
        $delegate->nationality_id='123232488';
        $delegate->password=bcrypt('123456');
        $delegate->personal_img='temps/eXTSErKsqjXZ4cQDpM09CMVLR018b15NhiWKIBZQ.jpeg';
        $delegate->city_id=8;
        $delegate->vehicle_type='car';
        $delegate->number_of_passengers=0;
        $delegate->dob=\Carbon\Carbon::now();
        $delegate->confirmation_date=\Carbon\Carbon::now();
        $delegate->social_status='single';
        $delegate->scientific_degree='Bachlor';
        $delegate->speak_languages=\GuzzleHttp\json_encode($langs);
        $delegate->vehicle_images=\GuzzleHttp\json_encode($vichel);
        $delegate->id_img='temps/eXTSErKsqjXZ4cQDpM09CMVLR018b15NhiWKIBZQ.jpeg';
        $delegate->car_licence_img='temps/cvTqN99xBi18wTI5C60REI67gEqkx82DrTHyz5dQ.jpeg';
        $delegate->device_token='dfhdndfnsdfgnmdfsgmn';
        $delegate->budget=100;
        $delegate->save();

    });
