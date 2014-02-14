<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Settings Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap --}}
    {{ HTML::style('css/styleApp.css', array('media' => 'screen')) }}
    {{-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --}}
    <!--[if lt IE 9]>
        {{ HTML::script('assets/js/html5shiv.js') }}
        {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->
   {{ HTML::style('packages/bootstrap/css/bootstrap.min.css'); }}
   {{ HTML::style('//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css'); }}
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script text="JavaScript">
    $(function() {
    $(".sortable").sortable({
		placeholder: "highlight"
	});
    $(".sortable").disableSelection();
  });
    </script>
</head>
<body>

	<div  class="container-fluid">
          @yield('content')
     </div>

{{ HTML::script('js/app.js'); }}
{{ HTML::script('packages/bootstrap/js/bootstrap.min.js'); }}
</body>
</html>
