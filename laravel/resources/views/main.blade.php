@extends('layouts.default')

@section('head')
<title>Welcome to Laravel Online Grade Query</title>
<link href="{{URL::to('asset/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
<style type="text/css">
  #top_view{ 
  background: url('{{URL::to('asset/images/bg.jpg')}}') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  height: 650px;
  margin-top: 0px;
  padding: 120px 100px;
  color: #fff;
}
.navbar{
  margin-bottom: 0px;
  border-radius: 0px;
}

.pe-7s-mouse{
  font-size: 58px;
}
span{
  font-size: 58px;
}
#services{
  padding: 60px 100px;
}

#location{
  background: url('{{URL::to('asset/images/loc.jpg')}}') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

   padding: 60px 100px;
   color: #fff;
}
#footer{
  padding: 20px 50px;

}
</style>
@endsection

@section('header')
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Online Grade</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{route('auth_login')}}"><i class="pe-7s-power"></i> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<div id="top_view">
  <h1 class="text-center">Online Grade System for Grade 1-10</h1>
  <center><i class="pe-7s-mouse"></i></center>
  <h4 class="text-center">Where Student Future is Encoded</h4>
</div>

<div id="services" class="row">
  <h1 class="text-center">Services</h1>
  <div class="col-md-4">
    <h2 class="text-center">Records</h2>
    <center>
      <span class="pe-7s-news-paper"></span>
      <p>We keep all our users records to make it easy to access.</p>
    </center>
  </div>
  <div class="col-md-4">
    <h2 class="text-center">Reliable</h2>
    <center>
      <span class="pe-7s-like2" ></span>
      <p>We provide accurate and appropriate data to our users.</p>
    </center>
  </div>
  <div class="col-md-4">
    <h2 class="text-center">Accessible</h2>
    <center>
      <span class="pe-7s-signal"></span>
      <p>We made your grades accesible everywhere anywhere you want and you feel convinent.</p>
    </center>
  </div>
</div>


<div id="location" class="row">
  <h1 class="text-center">Contact Us</h1>
  <div class="col-md-2">
    <center>
      <h2>Call Us</h2>
      <span class="pe-7s-call"></span>
      <p>123-456-789</p>
    </center>
  </div>

  <div class="col-md-8">
    <center><img src="{{URL::to('asset/images/schools.jpg')}}" height="500px" width="700px"></center>
  </div>

  <div class="col-md-2">
    <center>
      <h2>Email Us</h2>
      <span class="pe-7s-mail-open"></span>
      <p>eskavols@mail.com</p>
    </center>
  </div>
</div>

<div class="row" id="footer">
  <center>
    <p>All Right Reserved &copy; <?php echo date('Y');?> by: MORO</p>
  </center>
</div>
@endsection

@section('content')

@endsection

@section('footer')

@endsection
@section('scripts')
<script src="{{URL::to('assets2/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{URL::to('assets2/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection