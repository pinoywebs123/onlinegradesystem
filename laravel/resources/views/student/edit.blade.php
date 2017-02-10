

@extends('layouts.default')

@section('head')


<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link href="{{URL::to('asset/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />

 <link href="{{URL::to('assets2/css/animate.min.css')}}" rel="stylesheet"/>
 <!--  Light Bootstrap Table core CSS    -->
 <link href="{{URL::to('assets2/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>
 
 <style type="text/css">
     .col-md-3{
        width: 355px !important;
     }
 </style>
@endsection



@section('content')
<div class="wrapper">
    <div class="sidebar" data-color="orange" data-image="{{URL::to('assets2/img/sidebar-5.jpg')}}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
               <center>
                   <img src="{{URL::to('asset/images/student.png')}}" alt="Student Logo">
                   
               </center>
            </div>

            <ul class="nav">
                <li class="active">
                     <a href="{{route('student_main')}}">
                        <i class="pe-7s-home"></i>
                        <p>HOME</p>
                    </a>
                </li>
                 <li>
                     <a href="{{route('student_grade')}}">
                        <i class="pe-7s-note2"></i>
                        <p>Grade</p>
                    </a>
                </li>
                <li>
                     <a href="{{route('student_record')}}">
                        <i class="pe-7s-news-paper"></i>
                        <p>Record</p>
                    </a>
                </li>
                
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Student Panel</a>
                </div>
                <div class="collapse navbar-collapse">
                   

                    <ul class="nav navbar-nav navbar-right">
                         <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Auth::user()->first_name}}
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="{{route('student_setting')}}">Settings</a></li>
                              <li><a href="{{route('logout')}}"> Logout</a></li> 
                            </ul>
                          </li>
                        
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container-fluid">
             <div class="col-md-7">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4>Update Information</h4>
                    </div>
                    <div class="panel-body">
                        @foreach($edits as $edit)
                        <form>
                            <div class="input-group">
                                <span class="input-group-addon" id="addon1"><i class="pe-7s-user"></i></span>
                                <input type="text" name="lname" class="form-control" aria-describedby="addon1" value="{{$edit->last_name}}">
                            </div>
                             <div class="input-group">
                                <span class="input-group-addon" id="addon1"><i class="pe-7s-user"></i></span>
                                <input type="text" name="fname" class="form-control" aria-describedby="addon1" value="{{$edit->first_name}}">
                            </div>
                             <div class="input-group">
                                <span class="input-group-addon" id="addon1"><i class="pe-7s-user"></i></span>
                                <input type="text" name="mname" class="form-control" aria-describedby="addon1" value="{{$edit->middle_name}}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" id="addon1"><i class="pe-7s-user"></i></span>
                                <input type="text" name="email" class="form-control" aria-describedby="addon1" value="{{$edit->email}}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" id="addon1"><i class="pe-7s-user"></i></span>
                                <input type="text" name="contact" class="form-control" aria-describedby="addon1" value="{{$edit->contact}}">
                            </div>
                            <button class="btn btn-info btn-block">Update</button>
                        </form>
                        @endforeach
                    </div>
                </div>
             </div>  

             <div class="col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4>Information</h4>
                        
                    </div>
                    <div class="panel-body">
                        <p><i class="pe-7s-user"></i>{{Auth::user()->last_name}}, {{Auth::user()->first_name}} {{Auth::user()->middle_name}}</p>
                        <p><i class="pe-7s-mail-open-file"></i>{{Auth::user()->email}}</p>
                        <p><i class="pe-7s-call"></i>{{Auth::user()->contact}}</p>
                    </div>
                    
                </div>
                
                
             </div>    
        </div>



    </div>
</div>
@endsection

@section('footer')

@endsection

@section('scripts')
<script src="{{URL::to('assets2/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{URL::to('assets2/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection