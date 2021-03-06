<div class="row dashboard-top-nav">
    <div class="col-sm-3 logo">
        @if(Auth::check())
            <?php
            $school_name = null;
            $id = Auth::user()->school_id;
            if($id != null){
                $school_name = \App\Models\School::where('id',$id)->pluck('name')->first();
            }
            ?>
                @if($school_name != null)
                    <h5><i class="fa fa-book"></i>{{$school_name}}</h5>
                    @endif
        @else
            <h5><i class="fa fa-book"></i>MYESCHOOL</h5>

        @endif
    </div>
{{--    <div class="col-sm-4 top-search">
        <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Search">
        </div>
    </div>--}}
    <div class="col-sm-5 notification-area pull-right">
        <ul class="top-nav-list">
            <li class="notification dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge nav-badge">3</span>
                </a>
                <ul class="dropdown-menu notification-list">
                    <li>
                        <div class="list-msg">
                            <div class="col-xs-2 icon clear-padding">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <div class="col-sm-10 desc">
                                <h5><a href="#">Upcoming Sports Meet</a></h5>
                                <h6><i class="fa fa-clock-o"></i> 10 min ago</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li>
                        <div class="list-msg">
                            <div class="col-xs-2 icon clear-padding">
                                <i class="fa fa-paint-brush"></i>
                            </div>
                            <div class="col-sm-10 desc">
                                <h5><a href="#">Fine art workshop</a></h5>
                                <h6><i class="fa fa-clock-o"></i> 1 hour ago</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li>
                        <div class="list-msg">
                            <div class="col-xs-2 icon clear-padding">
                                <i class="fa fa-birthday-cake"></i>
                            </div>
                            <div class="col-sm-10 desc">
                                <h5><a href="#">Annual fest</a></h5>
                                <h6><i class="fa fa-clock-o"></i> 1 day ago</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li>
                        <div class="list-msg">
                            <div class="col-xs-2 icon clear-padding">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <div class="col-sm-10 desc">
                                <h5><a href="#">Upcoming Sports Meet</a></h5>
                                <h6><i class="fa fa-clock-o"></i> 10 min ago</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li>
                        <div class="all-notifications">
                            <a href="#">VIEW ALL NOTIFICATIONS</a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="message dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-comment-o"></i>
                    <span class="badge nav-badge">5</span>
                </a>
                <ul class="dropdown-menu notification-list">
                    <li>
                        <div class="list-msg">
                            <div class="col-xs-2 image clear-padding">
                                <img src="{{asset('public/img/placeholder.png')}}" alt="user" />
                            </div>
                            <div class="col-sm-10 desc">
                                <h5><a href="#">John Doe</a></h5>
                                <p>Lorem Ipsum is simply dummy text.</p>
                                <h6><i class="fa fa-clock-o"></i> 1 day ago</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li>
                        <div class="list-msg">
                            <div class="col-xs-2 image clear-padding">
                                <img src="{{asset('assets/img/parent/parent1.jpg')}}" alt="user" />
                            </div>
                            <div class="col-sm-10 desc">
                                <h5><a href="#">Lenore Doe</a></h5>
                                <p>Lorem Ipsum is simply dummy text.</p>
                                <h6><i class="fa fa-clock-o"></i> 1 day ago</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li>
                        <div class="all-notifications">
                            <a href="#">VIEW ALL MESSAGES</a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="user dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>
                        @if(Auth::user()->avatar != null)
                            <img src="{{asset('img/profile/'.Auth::user()->avatar)}}" alt="user" />
                        @else
                            <img src="{{asset('img/placeholder.png')}}" alt="user" />
                        @endif
                        @if(Auth::check())
                            {{Auth::user()->name}}
                            @endif
                        <span class="caret"></span></span>
                </a>
                <ul class="dropdown-menu notification-list">
                    @role('admin')
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href="{{route('admin.profile.show')}}"><i class="fa fa-users"></i> USER PROFILE</a>
                    </li>
                    <li>
                        <a href="{{route('admin.passwords.show')}}"><i class="fa fa-key"></i> CHANGE PASSWORD</a>
                    </li>
                    {{--<li>
                        <a href="#"><i class="fa fa-cogs"></i> SETTINGS</a>
                    </li>--}}
                    @endrole
                    @role('super')
                    <li>
                        <a href="{{route('super.home')}}"><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href="{{route('super.profile.show')}}"><i class="fa fa-users"></i> USER PROFILE</a>
                    </li>
                    <li>
                        <a href="{{route('super.passwords.show')}}"><i class="fa fa-key"></i> CHANGE PASSWORD</a>
                    </li>
                    {{--<li>
                        <a href="#"><i class="fa fa-cogs"></i> SETTINGS</a>
                    </li>--}}
                    @endrole
                    @role('teacher')
                    <li>
                        <a href=""><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-users"></i> USER PROFILE</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-key"></i> CHANGE PASSWORD</a>
                    </li>
                    {{--<li>
                        <a href="#"><i class="fa fa-cogs"></i> SETTINGS</a>
                    </li>--}}
                    @endrole
                    @role('accountant')
                    <li>
                        <a href=""><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-users"></i> USER PROFILE</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-key"></i> CHANGE PASSWORD</a>
                    </li>
                    {{--<li>
                        <a href="#"><i class="fa fa-cogs"></i> SETTINGS</a>
                    </li>--}}
                    @endrole
                    @role('student')
                    <li>
                        <a href=""><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-users"></i> USER PROFILE</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-key"></i> CHANGE PASSWORD</a>
                    </li>
                    {{--<li>
                        <a href="#"><i class="fa fa-cogs"></i> SETTINGS</a>
                    </li>--}}
                    @endrole
                    <li>
                        <div class="all-notifications">
                            <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">LOGOUT</a>
                        </div>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            {{csrf_field()}}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>

