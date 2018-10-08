<?php
Route::get('/','Admin\HomeController@home')->name('admin.home');

//notifications controller
Route::get('/messages','Admin\NotificationController@messages')->name('admin.messages');
Route::get('/annoucements','Admin\NotificationController@annoucements')->name('admin.annoucements');

Route::resources([
    'students'=>'Admin\StudentController',
    'teachers'=>'Admin\TeacherController',
    'classes'=>'Admin\ClassesController',
    'sections'=>'Admin\SectionController',
    'courses'=>'Admin\CourseController',
    'timetables'=>'Admin\TimeTableController',
    'class_courses'=>'Admin\ClassCourseController',
    'accountants'=>'Admin\AccountantController',
    'roles'=>'Admin\RoleController'
]);



//report controllers
Route::get('/reports-attendance','Admin\ReportController@teacherAttendance')->name('admin.reports.attendance');
Route::get('/reports-marks','Admin\ReportController@teacherMarks')->name('admin.reports.marks');

//details
Route::get('/school-details','Admin\DetailController@index')->name('admin.details.index');
Route::get('/school-details/items','Admin\DetailController@itemsIndex')->name('admin.details.items');
Route::post('/school-details/items/save','Admin\DetailController@saveItem')->name('admin.details.item.save');
Route::get('/school-details/academic-years','Admin\DetailController@academicIndex')->name('admin.details.academic');
Route::post('/school-details/academic-years/save','Admin\DetailController@saveAcademicYear')->name('admin.details.academic.save');
Route::delete('/school-details/academic-years/delete/{id}','Admin\DetailController@deleteAcademicYear')
    ->name('admin.details.academic.delete');
//terms routes
Route::get('/school-details/terms','Admin\DetailController@showTerms')->name('admin.details.terms');
Route::post('/school-details/terms/save','Admin\DetailController@saveTerms')->name('admin.details.terms.save');

//more items
Route::delete('/school-details/items/delete/{id}','Admin\DetailController@deleteItem')
    ->name('admin.details.items.delete');

//fee details
Route::get('/school-details/fees','Admin\DetailController@showFees')->name('admin.details.fees');
Route::post('/school-details/fees/save','Admin\DetailController@saveFees')->name('admin.details.fees.save');
Route::get('/school-details/fees/{id}','Admin\DetailController@showBreakDown')->name('admin.details.fees.details');
Route::get('/school-details/fees/terms/{id}','Admin\DetailController@showTermBreakdown')->name('admin.details.fees.term.details');
Route::get('/school-details/fees/terms/items/{id}','Admin\DetailController@showActualBreakdown')->name('admin.details.fees.actual_items.details');
Route::delete('/school-details/fees/delete/{id}','Admin\DetailController@deleteBreakDownItem')
    ->name('admin.details.fees.delete');

///edit years
Route::get('/school-details/terms/{id}','Admin\DetailController@showEditAcademic')->name('admin.details.term.show');
Route::post('/school-details/terms/update','Admin\DetailController@updateEditAcademic')->name('admin.details.term.update');

//edit terms
Route::get('/school-details/terms-year/{id}','Admin\DetailController@showEditTerm')->name('admin.details.term.year.show');
Route::post('/school-details/terms-year/update','Admin\DetailController@updateEditTerm')->name('admin.details.term.year.update');
Route::delete('/school-details/terms-year/delete/{id}','Admin\DetailController@deleteTerm')
    ->name('admin.details.terms.delete');

//sms routes
Route::get('sms/parents','Admin\SMSController@showParent')->name('admin.sms.parent');

//profile
Route::get('/profile','Admin\ProfileController@showProfile')->name('admin.profile.show');
Route::post('/profile','Admin\ProfileController@updateProfile')->name('admin.profile.update');
Route::get('/passwords','Admin\ProfileController@showPassword')->name('admin.passwords.show');
Route::post('/passwords','Admin\ProfileController@updatePassword')->name('admin.passwords.update');

//receipts
Route::get('/misc/receipt/print','Admin\ReceiptController@printStudentReceipt')->name('admin.student.receipt.print');