@extends('layouts.default');

@section('head')

<style type="text/css">
	
	   body{
 background: url('{{URL::to('asset/images/reg.jpg')}}') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

  font-family: 'Montserrat', Arial;
}
h1{
	color: #fff;
}

</style>
@endsection

@section('content')
<div class="container">
		@if(count($errors) > 0 )
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
				@endif
				
			
				<div class="col-md-4 col-md-offset-4 well">
					<ul class="nav nav-tabs">
					  <li role="presentation" class="active"><a href="{{route('register')}}">Student</a></li>
					  <li role="presentation"><a href="{{route('register_teacher')}}">Teacher</a></li>
					  
					</ul>
					<h2 class="text-center">Student</h2>
					<form action="{{route('registerHandle')}}" method="post">
					{{csrf_field()}}
						<div class="form-group">
						<label for="student_id">ID Number</label>
						<input type="text" name="student_id" class="form-control">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<label for="passwor2">Repeat Password</label>
						<input type="password" name="password2" class="form-control">
					</div>

					<div class="form-group">
						<label for="contact">Contact Us</label>
						<input type="text" name="contact" class="form-control">
					</div>

					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="fname" class="form-control">
					</div>
					<div class="form-group">
						<label for="mname">Middle Name</label>
						<input type="text" name="mname" class="form-control">
					</div>
					<div class="form-group">
						<label for="lname">Last Name</label>
						<input type="text" name="lname" class="form-control">
					</div>

					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="{{route('auth_login')}}"> Login &raquo;</a>
					</form>
				</div>

				
				
	
</div>
@endsection

@section('footer')

@endsection


@section('scripts')
<script src="{{URL::to('assets2/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{URL::to('assets2/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection


