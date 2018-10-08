<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="{{asset('assets/css/owl.carousel.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/css/owl.theme.default.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" media="screen">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" media="screen">

</head>
<body>
  @include('partials.alert')
<div id="app">
    <div class="row nav-row trans-menu">
        <div class="container nav-container">
            <div class="top-navbar">
                <div class = "pull-right">
                    <div class="top-nav-social pull-left">
                        <a href="https://www.facebook.com/myeschoolghana" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/myeschoolghana" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.twitter.com/myeschoolghana" target="_blank"><i class="fa fa-twitter"></i></a>
                    </div>
                    <div class="top-nav-login-btn pull-right">
                        <a href="{{route('login.validate')}}" ><i class="fa fa-sign-in"></i>LOGIN</a>
                        <a href="{{route('school.register')}}"  data-target="#loginModal"><i class="fa fa-sign-in"></i>REGISTER</a>
                    </div>
                    <!--<div class="top-navbar-search pull-right">
                        <i class="fa fa-search"></i>
                        <input type = "text" placeholder = "Search"/>
                    </div>-->
                </div>
                <div class = "clearfix"></div>
            </div>
            <div class = "clearfix"></div>

        </div>
    </div>



   {{--new--}}
    <div class="row">
        <div id="homeSlider" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#homeSlider" data-slide-to="0" class="active"></li>
                <li data-target="#homeSlider" data-slide-to="1"></li>
                <li data-target="#homeSlider" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="assets/img/slider/slide5.jpg" alt="slide1">
                </div>

                <div class="item">
                    <img src="assets/img/slider/slide6.jpg" alt="slide2">
                </div>
                <div class="item">
                    <img src="assets/img/slider/slide4.jpg" alt="slide2">
                </div>
            </div>

            <!-- Slide Controls -->
            <a class="left carousel-control" href="#homeSlider" role="button" data-slide="prev">
                <span class="fa fa-arrow-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#homeSlider" role="button" data-slide="next">
                <span class="fa fa-arrow-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="row contact-row">
    <div class="container">
      <div class="contact-form col-sm-6">
        <div class="col-xs-12">
          <h3><i class="fa fa-edit"></i>WRITE TO US.</h3>
        </div>
        <form method="post" action="{{route('user.contact.us')}}">
          {{csrf_field()}}
        <div class="col-xs-6">
          <label>FIRST NAME</label>
          <input type="text" placeholder="First Name" name="firstname" class="form-control" required>
        </div>

        <div class="col-xs-6">
          <label>LAST NAME</label>
          <input type="text" placeholder="LAST NAME" name="lastname" class="form-control">
        </div>

        <div class="clearfix"></div>

        <div class="col-xs-12">
          <label>EMAIL</label>
          <input type="email" placeholder="Email" name="email" class="form-control" required>
        </div>

        <div class="col-xs-12">
          <label>YOUR MESSAGE</label>
          <textarea rows="3" placeholder="Write your message here" class="form-control" name="message" required ></textarea>
        </div>

        <hr>

        <div class="col-xs-12">
          <button type="submit" class="btn btn-success btn-block" style="margin-top:10px">SEND</button>
        </div>

        <div class="clearfix"></div>
        </form>
      </div>


      <div class="col-sm-6 address-box">
        <h3><i class="fa fa-phone"></i>CONTACT US.</h3>
        <div class="address-body">
          <div class="address-item">
            <div class="col-xs-1">
              <i class="fa fa-map-marker"></i>
            </div>
            <div class="col-xs-11">
              <p> Cantonment Opp. Joyce Ababio School</p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="address-item">
            <div class="col-xs-1">
              <i class="fa fa-envelope-o"></i>
            </div>
            <div class="col-xs-11">
              <p><a href="mailto: info@tecunitgh.com">info@tecunitgh.com</a></p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="address-item">
            <div class="col-sm-1">
              <i class="fa fa-phone"></i>
            </div>
            <div class="col-xs-11">
              <p>+233 307001081</p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="address-item no-border">
            <div class="col-xs-1">
              <i class="fa fa-clock-o"></i>
            </div>
            <div class="col-xs-11">
              <p>MON to FRI: 09:00 AM - 05:00 PM </p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>


</div>


<!-- Scripts -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/plugins/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/js.js')}}"></script>

</body>
</html>
