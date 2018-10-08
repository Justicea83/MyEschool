<div class="sidebar-nav-wrapper" id="sidebar-wrapper">

    <ul class="sidebar-nav">
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

    </ul>
</div>