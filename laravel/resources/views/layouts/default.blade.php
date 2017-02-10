<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{URL::to('assets2/img/favicon.ico')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="stylesheet" type="text/css" href="{{URL::to('asset/css/bootstrap.min.css')}}">
	@yield('head')
</head>
<body>
<div class="container-fluid">
	<div class="row">
		@yield('header')
	</div>

	<div class="row">
		@yield('content')
	</div>

	<div class="row">
		@yield('footer')
	</div>
</div>

</body>
@yield('scripts')
</html>