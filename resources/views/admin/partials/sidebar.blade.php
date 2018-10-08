<div class="sidebar-nav-wrapper" id="sidebar-wrapper">

    <ul class="sidebar-nav">
        @role('super')
        <li>
            <a href="{{route('super.home')}}"><i class="fa fa-home menu-icon"></i> HOME</a>
        </li>
        <li>
            <a href="{{route('schools.index')}}"><i class="fa fa-graduation-cap menu-icon"></i> MANAGE SCHOOLS</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user menu-icon"></i> PROFILE <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('super.profile.show')}}"><i class="fa fa-caret-right"></i>SHOW PROFILE</a>
                </li>
                <li style="padding-bottom: 40px;">
                    <a href="{{route('super.passwords.show')}}"><i class="fa fa-caret-right" ></i>CHANGE PASSWORD</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        @endrole

        @role('admin')
        <li>
            <a href="{{route('admin.home')}}"><i class="fa fa-home menu-icon"></i> HOME</a>
        </li>

        <li>
            <a href="{{route('roles.index')}}"><i class="fa fa-lock menu-icon"></i> MANAGE ROLES</a>
        </li>
        <li>
            <a href="{{route('admin.details.index')}}"><i class="fa fa-info menu-icon"></i> MANAGE DETAILS</a>
        </li>
        <li>
            <a href="{{route('courses.index')}}"><i class="fa fa-subway menu-icon"></i> COURSES</a>
        </li>
        @if(Auth::user()->can('add_student_fee_payments'))
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-file-code-o menu-icon"></i> BILLS <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('accountant.pay-fees')}}"><i class="fa fa-caret-right"></i>PAY_FEES</a>
                    </li>
                    <li>
                        <a href="{{route('transactions.index')}}"><i class="fa fa-caret-right"></i>TRANSACTIONS</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </li>
            @endif
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-users menu-icon"></i> STUDENTS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('students.create')}}"><i class="fa fa-caret-right"></i>ADD</a>
                </li>
                <li>
                    <a href="{{route('students.index')}}"><i class="fa fa-caret-right"></i>ALL STUDENT  </a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-money menu-icon"></i> ACCOUNTANT <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('accountants.create')}}"><i class="fa fa-caret-right"></i>ADD</a>
                </li>
                <li>
                    <a href="{{route('accountants.index')}}"><i class="fa fa-caret-right"></i>ALL ACCOUNTANTS</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user-secret menu-icon"></i> TEACHERS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('teachers.create')}}"><i class="fa fa-caret-right"></i>ADD</a>
                </li>
                <li>
                    <a href="{{route('teachers.index')}}"><i class="fa fa-caret-right"></i>ALL TEACHER</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        {{--<li>
            <a href="{{route('admin.messages')}}"><i class="fa fa-envelope menu-icon"></i> MY MESSAGES</a>
        </li>
        <li>
            <a href="{{route('admin.annoucements')}}"><i class="fa fa-bullhorn menu-icon"></i> ANNOUNCEMENTS</a>
        </li>--}}
        @if(Auth::user()->can('browse_classes'))
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file-o menu-icon"></i> CLASSES <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('classes.create')}}"><i class="fa fa-caret-right"></i>ADD CLASS</a>
                </li>
                <li>
                    <a href="{{route('classes.create')}}"><i class="fa fa-caret-right"></i>VIEW CLASSES</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        @endif
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-book menu-icon"></i> SUBJECTS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('class_courses.create')}}"><i class="fa fa-caret-right"></i>ADD</a>
                </li>
                <li>
                    <a href="{{route('class_courses.index')}}"><i class="fa fa-caret-right"></i>VIEW SUBJECTS</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        {{--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-calendar menu-icon"></i> TIMETABLE <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('timetables.create')}}"><i class="fa fa-caret-right"></i>CREATE</a>
                </li>
                <li>
                    <a href="{{route('timetables.index')}}"><i class="fa fa-caret-right"></i>VIEW</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>--}}


        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-address-card menu-icon"></i> REPORTS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('admin.reports.attendance')}}"><i class="fa fa-caret-right"></i>ATTENDENCE</a>
                </li>
                <li>
                    <a href="{{route('admin.reports.marks')}}"><i class="fa fa-caret-right"></i>MARKS</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope menu-icon"></i> SMS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('admin.sms.parent')}}"><i class="fa fa-caret-right"></i>SMS TO PARENT</a>
                </li>
                <li>
                    <a href=""><i class="fa fa-caret-right"></i>TO TEACHER</a>
                </li>
                <li>
                    <a href=""><i class="fa fa-caret-right" ></i>DEFAULT</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user menu-icon"></i> PROFILE <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('admin.profile.show')}}"><i class="fa fa-caret-right"></i>SHOW PROFILE</a>
                </li>
                <li style="padding-bottom: 40px;">
                    <a href="{{route('admin.passwords.show')}}"><i class="fa fa-caret-right" ></i>CHANGE PASSWORD</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>

        @endrole
        @role('student')
        <li>
            <a href="{{route('student.home')}}"><i class="fa fa-home menu-icon"></i> HOME</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file-code-o menu-icon"></i> ASSIGNMENTS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('students.ass.download')}}"><i class="fa fa-caret-right"></i>DOWNLOAD</a>
                </li>
                <li>
                    <a href="{{route('student.ass.upload')}}"><i class="fa fa-caret-right"></i>UPLOAD</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bar-chart menu-icon"></i> ATTENDENCE <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('student.att.summary')}}"><i class="fa fa-caret-right"></i>SUMMARY</a>
                </li>
                <li>
                    <a href="{{route('student.att.detail')}}"><i class="fa fa-caret-right"></i>DETAILED</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li>
            <a href="{{route('student.messages.show')}}"><i class="fa fa-envelope menu-icon"></i> MY MESSAGES</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-address-card menu-icon"></i> VIEW MARKS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('student.assessment.show')}}"><i class="fa fa-caret-right"></i>CLASS ASSESSMENT</a>
                </li>
                <li>
                    <a href="{{route('student.assessment.mid')}}"><i class="fa fa-caret-right"></i>MID TERM</a>
                </li>
                <li>
                    <a href="{{route('student.assessment.end')}}"><i class="fa fa-caret-right"></i>END TERM</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li>
            <a href="{{route('student.timetable')}}"><i class="fa fa-calendar menu-icon"></i> TIME TABLE</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-book menu-icon"></i> EXAMINATION <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('student.exam.plan')}}"><i class="fa fa-caret-right"></i>SEATING PLAN</a>
                </li>
                <li>
                    <a href="{{route('student.exam.schedule')}}"><i class="fa fa-caret-right"></i>EXAM SCHEDULE</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li>
            <a href="{{route('student.fee')}}"><i class="fa fa-money menu-icon"></i> FEE DETAILS</a>
        </li>
        @endrole
        @role('teacher')
        <li>
            <a href="{{route('teacher.home')}}"><i class="fa fa-home menu-icon"></i> HOME</a>
        </li>
        @if(Auth::user()->can('browse_students'))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-users menu-icon"></i> STUDENTS <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->can('add_students'))
                        <li>
                            <a href="{{route('students.create')}}"><i class="fa fa-caret-right"></i>ADD</a>
                        </li>
                        @endif
                    <li>
                        <a href="{{route('students.index')}}"><i class="fa fa-caret-right"></i>ALL STUDENT  </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </li>
            @endif
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file-code-o menu-icon"></i> ASSIGNMENTS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('teacher.assignment.create')}}"><i class="fa fa-caret-right"></i>CREATE</a>
                </li>
                <li>
                    <a href="{{route('teacher.assignment.download')}}"><i class="fa fa-caret-right"></i>DOWNLOAD</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bar-chart menu-icon"></i> ATTENDENCE <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('teacher.attendance.mark')}}"><i class="fa fa-caret-right"></i>MARK</a>
                </li>
                <li>
                    <a href="{{route('teacher.attendance.view')}}"><i class="fa fa-caret-right"></i>VIEW</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        {{--<li>
            <a href="{{route('teacher.messages')}}"><i class="fa fa-envelope menu-icon"></i> MY MESSAGES</a>
        </li>--}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-address-card menu-icon"></i> MARKS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('teacher.marks.add')}}"><i class="fa fa-caret-right"></i>CREATE</a>
                </li>
                <li>
                    <a href="{{route('teacher.marks.view')}}"><i class="fa fa-caret-right"></i>VIEW</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        {{--<li>
            <a href="{{route('teacher.timetable')}}"><i class="fa fa-calendar menu-icon"></i> TIME TABLE</a>
        </li>--}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-address-card menu-icon"></i> REPORTS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('teacher.report.attendance')}}"><i class="fa fa-caret-right"></i>ATTENDENCE</a>
                </li>
                <li>
                    <a href="{{route('teacher.report.marks')}}"><i class="fa fa-caret-right"></i>MARKS</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        @endrole
        @role('accountant')
        <li>
            <a href="{{route('accountant.home')}}"><i class="fa fa-home menu-icon"></i> HOME</a>
        </li>
        <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file-code-o menu-icon"></i> BILLS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('accountant.pay-fees')}}"><i class="fa fa-caret-right"></i>PAY_FEES</a>
                </li>
                <li>
                    <a href="{{route('transactions.index')}}"><i class="fa fa-caret-right"></i>TRANSACTIONS</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        @endrole
        @role('guardian')
        <li>
            <a href="student-dashboard.html"><i class="fa fa-home menu-icon"></i> HOME</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file-code-o menu-icon"></i> ASSIGNMENTS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="student-assignment-download.html"><i class="fa fa-caret-right"></i>DOWNLOAD</a>
                </li>
                <li>
                    <a href="student-assignment-upload.html"><i class="fa fa-caret-right"></i>UPLOAD</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bar-chart menu-icon"></i> ATTENDENCE <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="student-attendence.html"><i class="fa fa-caret-right"></i>SUMMARY</a>
                </li>
                <li>
                    <a href="student-attendence-detailed.html"><i class="fa fa-caret-right"></i>DETAILED</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li>
            <a href="message.html"><i class="fa fa-envelope menu-icon"></i> MY MESSAGES</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-address-card menu-icon"></i> VIEW MARKS <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="student-marks.html"><i class="fa fa-caret-right"></i>CLASS ASSESSMENT</a>
                </li>
                <li>
                    <a href="student-marks.html"><i class="fa fa-caret-right"></i>MID TERM</a>
                </li>
                <li>
                    <a href="student-marks.html"><i class="fa fa-caret-right"></i>END TERM</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li>
            <a href="student-timetable.html"><i class="fa fa-calendar menu-icon"></i> TIME TABLE</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-book menu-icon"></i> EXAMINATION <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="student-exam-plan.html"><i class="fa fa-caret-right"></i>SEATING PLAN</a>
                </li>
                <li>
                    <a href="student-exam-schedule.html"><i class="fa fa-caret-right"></i>EXAM SCHEDULE</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </li>
        <li>
            <a href="student-fees.html"><i class="fa fa-money menu-icon"></i> FEE DETAILS</a>
        </li>
        @endrole
    </ul>
</div>