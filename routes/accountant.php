<?php
Route::get('/','Accountant\HomeController@home')->name('accountant.home');

// Route::resource('/','Admin\AccountantController');
Route::get('/fees-collection','Accountant\HomeController@getFee')->name('accountant.pay-fees');
Route::resources([
    'transactions'=>'Accountant\TransactionController'
]);
Route::post('/fees-collection/save','Accountant\FeePaymentController@saveFees');
