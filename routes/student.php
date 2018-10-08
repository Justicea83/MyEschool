<?php
Route::get('/','Student\HomeController@home')->name('student.home');

//assignment routes
Route::get('/assignment-download','Student\AssignmentController@showDownload')->name('students.ass.download');
Route::get('/assignment-upload','Student\AssignmentController@showUpload')->name('student.ass.upload');
Route::get('assignment-download/{date}','Student\AssignmentController@showAssDetails')->name('student.ass.down.detail');
Route::get('assignment-download/download/{file}','Student\AssignmentController@downloadAss')->name('student.ass.down.file');

//attendance routes
Route::get('/attendance-summary','Student\AttendanceController@showSummary')->name('student.att.summary');
Route::get('/attendance-detail','Student\AttendanceController@showDetailed')->name('student.att.detail');

//showNotifications
Route::get('/student-messages','Student\NotificationController@showNotifications')->name('student.messages.show');

//marks routes
Route::get('/assessment','Student\MarkController@showMarks')->name('student.assessment.show');
Route::get('/mid-term','Student\MarkController@showMarks')->name('student.assessment.mid');
Route::get('/end-term','Student\MarkController@showMarks')->name('student.assessment.end');

//timetable routes
Route::get('/timetable','Student\TimetableController@showTimetable')->name('student.timetable');

//exams routes
Route::get('/exam-plan','Student\ExamController@showPlan')->name('student.exam.plan');
Route::get('/exam-schedule','Student\ExamController@showSchedule')->name('student.exam.schedule');

//fees routes
Route::get('/fees','Student\FeeController@showFees')->name('student.fee');





?>

