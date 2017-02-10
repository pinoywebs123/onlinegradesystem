

@extends('layouts.default')

@section('head')


<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link href="{{URL::to('asset/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />

 <link href="{{URL::to('assets2/css/animate.min.css')}}" rel="stylesheet"/>
 <!--  Light Bootstrap Table core CSS    -->
 <link href="{{URL::to('assets2/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>
 
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
                <li>
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
                <li class="active">
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
        <h1 class="text-center">Summary Records</h1>
        @foreach($groups as $group)
             <div class="col-md-4">
                <img src="{{URL::to('asset/images/class.png')}}" height="200px" width="200px">
                <a href="{{route('record_level', ['level'=>$group->level])}}"><p class="badge">{{$group->level}}</p></a>           
            </div>
            
        @endforeach

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