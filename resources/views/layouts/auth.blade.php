<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Tracking Ms</title>

    <link rel="stylesheet" href="{{ asset('/css/app.css')}}">
</head>
<body>
    
    <div class="container" id="forms-beautifier">
        <div class="row">
            <div class="col-md-8 mt-5">
                <img src="{{asset('/images/login.svg')}}" alt="auth" width="100%">
            </div>
            <div class="col-md-4">
                @yield('content')
            </div>
        </div>
    </div>


</body>
</html>