<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BOOKS</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			@include ('partials.menu')
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mt-2">
			@yield('content')
		</div>
	</div>
</div>
@section('scripts')
<script src="{{asset('js/app.js')}}"></script>
@show	
</body>
</html>