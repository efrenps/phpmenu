<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Finance Menu')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap --}}
    {{ HTML::style('packages/bootstrap/css/bootstrap.css', array('media' => 'screen')) }}
    {{ HTML::style('css/styleApp.css', array('media' => 'screen')) }}
    {{-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --}}
    <!--[if lt IE 9]>
        {{ HTML::script('assets/js/html5shiv.js') }}
        {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->
    {{ HTML::style('packages/kendoUI/styles/kendo.common.min.css'); }}
    {{ HTML::style('packages/kendoUI/styles/kendo.default.min.css'); }}
    {{ HTML::style('packages/kendoUI/styles/kendo.bootstrap.min.css'); }}
    
</head>
<body>

	<div id="Principal" class="container-fluid">
          @yield('content')
     </div>
	
	{{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    {{-- Include all compiled plugins (below), or include individual files as needed --}}
    {{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script('js/jquery-ui-1.10.4.custom.min.js') }}    
    
{{ HTML::script('packages/kendoUI/js/jquery.min.js'); }}
{{ HTML::script('packages/kendoUI/js/kendo.all.min.js'); }}
{{ HTML::script('js/app.js'); }}    

</body>
</html>