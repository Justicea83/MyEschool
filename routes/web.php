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

Route::get('/', 'HomeController@welcome');

Route::get('/register','HomeController@register')->name('school.register');

Route::get('/login','HomeController@login')->name('login.validate');

Route::post('/register-school','Misc\MiscController@regSchool');
Route::post('/login-user','Misc\MiscController@login');
//verify user
Route::get('/user/verify/{token}', 'Misc\MiscController@verifyUser');
Route::post('/logout','Misc\MiscController@logout')->name('user.logout');

//password resets
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

//endpoints with the authentication
Route::get('/teachers/endpoint','Misc\EndPointController@names')->name('teacher.names.endpoint');
Route::get('/teachers-classes/endpoint','Misc\EndPointController@teacherClass')->name('teacher.classes.endpoint');

//items endpoint
Route::get('/items/endpoint','Misc\EndPointController@items')->name('items.fees.endpoint');
Route::get('/date/generation','Misc\EndPointController@generateYears');
//academic year endpoint
Route::get('/date/academic/years','Misc\EndPointController@showAcademicYears')->name('date.academic.years');
///term endpoints
Route::get('/date/acade/terms','Misc\EndPointController@showFromYearsTable');
Route::get('/date/academic/terms','Misc\EndPointController@makeDataTableTerms')->name('date.academic.terms');
Route::get('/date/terms/{name}','Misc\EndPointController@showTerms');
//fees endpoint particulars
Route::get('/date/items/show-all','Misc\EndPointController@showAllItems');
Route::get('/date/classes/show-all','Misc\EndPointController@showAllClasses');
//fees endpoint
Route::get('/date/fees/class-distinct','Misc\EndPointController@feesDistinctClass')->name('date.fees.class_distinct');

//courses endpoint
Route::get('/date/courses/show-all','Misc\EndPointController@allCourses')->name('date.courses.show.all');
Route::get('/date/class-courses/show-all','Misc\EndPointController@allClassCourses')->name('date.class_courses.show.all');

Route::get('/date/parents/all','Misc\EndPointController@showParents');

Route::post('/submit_comment','Misc\ContactUsController@store')->name('user.contact.us');

//fees payment
Route::get('/date/students/all/{id}','Misc\EndPointController@showParticularStudent');
Route::get('/date/students/all/previous/{id}','Misc\EndPointController@showStudentPrevious');
Route::get('/date/all/universities','Misc\EndPointController@getAllUniversities');
Route::get('/date/all/universities/years','Misc\EndPointController@allYearsPassed');

