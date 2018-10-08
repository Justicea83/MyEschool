<?php
Route::get('/','Teacher\HomeController@home')->name('teacher.home');
Route::resources([
    'assignments'=>'Teacher\AssController',
]);
//assignment routes
Route::get('/assignment-create','Teacher\AssignmentController@showCreate')->name('teacher.assignment.create');
Route::get('/assignment-download','Teacher\AssignmentController@showDownload')->name('teacher.assignment.download');

//attendance routes
Route::get('/attendance-view/data/{id}','Teacher\AttendanceController@attendanceInfo')->name('teacher.attendance.view.details');
Route::get('/attendance-mark','Teacher\AttendanceController@showMark')->name('teacher.attendance.mark');
Route::get('/attendance-view/{id}','Teacher\AttendanceController@showAttendanceInfo');
Route::post('/attendance-mark/save','Teacher\AttendanceController@markAttendance')->name('teacher.attendance.mark.save');
Route::get('/attendance-view','Teacher\AttendanceController@showView')->name('teacher.attendance.view');
Route::post('/attendance-view/update','Teacher\AttendanceController@updateAttendanceInfo');

//showMessage
Route::get('/teacher-messages','Teacher\NotificationController@showMessage')->name('teacher.messages');

//marks routes
Route::get('/marks-view','Teacher\MarkController@showView')->name('teacher.marks.view');
Route::get('/marks-add','Teacher\MarkController@showAdd')->name('teacher.marks.add');

//timetable
Route::get('/teacher-timetable','Teacher\TimetableController@showTimetable')->name('teacher.timetable');

//report routes
Route::get('/teacher-report-attendance','Teacher\ReportController@showAttendance')->name('teacher.report.attendance');
Route::get('/teacher-report-marks','Teacher\ReportController@showMarks')->name('teacher.report.marks');


