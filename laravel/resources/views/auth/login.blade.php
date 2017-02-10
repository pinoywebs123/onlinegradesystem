@extends('layouts.default')

@section('head')
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://sscol.jebal.comuv.com/css/font.css">

<style type="text/css">
	
	   body{
  background: #232426;
  font-family: 'Montserrat', Arial;
  font-size: 1em;
}


.ribbon{
  background: rgba(200,200,200,.5);
  width: 50px;
  height: 70px;
  margin: 0 auto;
  position: relative;
  top: 19px;
  border: 1px solid rgba(255,255,255,.3);
  border-top: 2px solid rgba(255,255,255,.5);
  border-bottom: 0;  
  border-radius: 5px 5px 0 0;
  box-shadow: 0 0 3px rgba(0,0,0,.7); 
}
.ribbon:before{
  content:"";
  display: block;
  width: 15px;
  height: 15px;
  background: #4E535B;
  border: 4px solid #cfd0d1;
  margin: 18px auto;
  box-shadow: inset 0 0 5px #000, 0 0 2px #000, 0 1px 1px 1px #A7A8AB;
  border-radius: 100%;
}
.login{
  background: #F1F2F4;
  border-bottom: 2px solid #C5C5C8;
  border-radius: 5px;
  text-align: center;
  color: #36383C;
  text-shadow: 0 1px 0 #FFF;
  max-width: 400px;
  margin: 0 auto;
  padding: 15px 40px 20px 40px;
  box-shadow: 0 0 3px #000;
}
.login:before{
  content:"";
  display: block;
  width: 70px;
  height: 4px;
  background: #4E535B;
  border-radius: 5px;
  border-bottom: 1px solid #FFFFFF;
  border-top: 2px solid #CBCBCD;
  margin: 0 auto;
}

.input{
  text-align: right;
  background: #E5E7E9;
  border-radius: 5px;
  overflow: hidden;
  box-shadow: inset 0 0 3px #65686E;
  border-bottom: 1px solid #FFF;
}
input{
  width: 260px;
  background: transparent;
  border: 0;
  line-height: 3.6em;
  box-sizing: border-box;
  color: #71747A;
  font-family:'Helvetica Neue';
  text-shadow: 0 1px 0 #FFF;
}
input:focus{
  outline: none;
}
.blockinput{
  border-bottom: 1px solid #BDBFC2;
  border-top: 1px solid #FFFFFF;
}
.blockinput:first-child{
  border-top: 0;
}
.blockinput:last-child{
  border-bottom: 0;
}
.blockinput i{
  padding-right: 10px;
  color: #B1B3B7;
  text-shadow: 0 1px 0 #FFF;
}
::-webkit-input-placeholder {
  color: #71747A;
  font-family:'Helvetica Neue';
  text-shadow: 0 1px 0 #FFF;
}
button{
  margin-top: 20px;
  display: block;
  width: 100%;
  line-height: 2em;
  background: rgba(114,212,202,1);
  border-radius: 5px;
  border:0;
  border-top: 1px solid #B2ECE6;
  box-shadow: 0 0 0 1px #46A294, 0 2px 2px #808389;
  color: #FFFFFF;
  font-size: 1.5em;
  text-shadow: 0 1px 2px #21756A;
}
button:hover{
 background: linear-gradient(to bottom, rgba(107,198,186,1) 0%,rgba(57,175,154,1) 100%);  
}
button:active{
  box-shadow: inset 0 0 5px #000;
  background: linear-gradient(to bottom, rgba(57,175,154,1) 0%,rgba(107,198,186,1) 100%); 
}

.input-group{
  margin-bottom: 10px;
}
</style>
@endsection

@section('content')

	

	<div class="ribbon"></div>
	  <div class="login">
	    <h1><a href="{{url('/')}}"><img src="{{URL::to('asset/images/logo.png')}}"></a></h1>
	    <p>Access your grade everywhere</p>
	    @if(count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
			@endif
	    <form action="{{route('student_loginHandler')}}" method="post">
	    	{{csrf_field()}}
	      <div class="input-group">
	      	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	      	<input type="text" name="student_id" class="form-control" placeholder="ID">
	      </div>
	      <div class="input-group">
	      	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	      	<input type="password" name="password" class="form-control" placeholder="Password">
	      </div>
	      <button type="submit">Login</button>
        <h5><a href="{{route('register')}}">No Account?</a></h5>
	    </form>
	  </div>
	
@endsection
