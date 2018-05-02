<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{isset($title) ? $title : 'Админ-панель'}}</title>

    <!-- Styles -->
    <link href="{{ mix('administrator/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

    @include('administrator.partials.navbar')
    <div class="container mt-4">
        <div class="row">
            <div class="col">

                <h1 class="mb-4">{{isset($title) ? $title : ''}}</h1>

                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="{{mix('administrator/js/app.js')}}"></script>
</body>
</html>
