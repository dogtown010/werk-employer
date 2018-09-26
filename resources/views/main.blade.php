<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Employer Marketing</title>
    <link rel="stylesheet" href="{{asset('css/foundation.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css" />
    <link rel="icon" href="{{asset('images/werk-favicon.png')}}" type="image/gif">

    <style>
        .error-validation{
            margin-top: -0.5rem;
            margin-bottom: 1rem;
            font-size: 0.75rem;
            font-weight: bold;
            color: #cc4b37;
        }
    </style>

</head>
<body>
    @yield('content')

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/what-input.js')}}"></script>
    <script src="{{asset('js/foundation.min.js')}}"></script>

    @yield('script')
</body>
</html>