<?php
Route::get('/','Super\HomeController@home')->name('super.home');

Route::resources([
    'schools'=>'Super\SchoolController'
]);
//profile
Route::get('/profile','Super\ProfileController@showProfile')->name('super.profile.show');
Route::post('/profile','Super\ProfileController@updateProfile')->name('super.profile.update');
Route::get('/passwords','Super\ProfileController@showPassword')->name('super.passwords.show');
Route::post('/passwords','Super\ProfileController@updatePassword')->name('super.passwords.update');