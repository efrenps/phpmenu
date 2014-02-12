<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Settings Page</title>
	{{ HTML::style('packages/kendoUI/styles/kendo.common.min.css'); }}
	{{ HTML::style('packages/kendoUI/styles/kendo.default.min.css'); }}
    {{ HTML::style('packages/kendoUI/styles/kendo.bootstrap.min.css'); }}
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css'); }}
</head>
<body>

@yield('content')

{{ HTML::script('packages/kendoUI/js/jquery.min.js'); }}
{{ HTML::script('packages/bootstrap/js/bootstrap.min.js'); }}	
{{ HTML::script('packages/kendoUI/js/kendo.all.min.js'); }}
{{ HTML::script('js/app.js'); }}	
</body>
</html>
