<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="/css/front.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>

        <style>
            html, body {
                height: 100%;
            }

            .container {
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
		<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		</script>
    </head>
    <body>
        <div class="container">
            <div class="content">
			 @yield('content')
            </div>
        </div>
    </body>
</html>
