@extends('layouts.default')

@section('head')
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link href="{{URL::to('asset/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />

 <link href="{{URL::to('assets2/css/animate.min.css')}}" rel="stylesheet"/>
 <!--  Light Bootstrap Table core CSS    -->
 <link href="{{URL::to('assets2/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>
 <style type="text/css">
     .pe-7s-users{
        font-size: 48px;
     }
 </style>
@endsection



@section('content')
<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="{{URL::to('assets2/img/sidebar-5.jpg')}}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
               <center>
                    <img src="{{URL::to('asset/images/teacher.png')}}">
                </center>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{route('teacher_main')}}">
                        <i class="pe-7s-graph"></i>
                        <p>HOME</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('teacher_class')}}">
                        <i class="pe-7s-graph3"></i>
                        <p>CLASS</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('add_student')}}">
                        <i class="pe-7s-graph1"></i>
                        <p>ADD STUDENT</p>
                    </a>
                </li>
                <li class="active">
                    <a href="{{route('add_teacher')}}">
                        <i class="pe-7s-graph1"></i>
                        <p>SUMMARY</p>
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
                    <a class="navbar-brand" href="#">Teacher Panel</a>
                </div>
                <div class="collapse navbar-collapse">
                   

                    <ul class="nav navbar-nav navbar-right">
                       <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Auth::user()->first_name}}
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="#">Settings</a></li>
                              <li><a href="{{route('logout')}}"> Logout</a></li> 
                            </ul>
                          </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container-fluid">
            <table class="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Level</th>
                                <th>Room</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @if( $summary_class->count() > 0)
                                @foreach($summary_class as $row)
                                    <tr>
                                        <td>{{$row->user_id}}</td>
                                        <td>{{$row->last_name}}</td>
                                        <td>{{$row->first_name}}</td>
                                        <td>{{$row->middle_name}}</td>
                                        <td>{{$row->level}}</td>
                                        <td>{{$row->room_number}}</td>
                                    </tr>
                                @endforeach
                                   
                            @endif
                        </tbody>

                    </table>

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