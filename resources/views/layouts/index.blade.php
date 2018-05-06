<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    {{-- Каптча --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>АрсХостел - уютный хостел в Арсеньеве.</title>

    <link rel="stylesheet" href="{{mix('css/app.css')}}">

    <link rel="shortcut icon" type="image/png" href="{{asset('favicon.png')}}">

    @include('blocks.meta-description')
</head>
<body>
<main id="#top">
    @include('partials.navbar.navbar')
    @include('partials.navbar.mobile-navbar')

    @include('sections.header')

    @include('sections.rooms')

    @include('sections.advantages')

    @include('sections.gallery')

    @include('sections.reviews')

    @include('sections.contact-form')

    @include('sections.map')

    @include('sections.footer')
</main>

<script src="{{mix('js/app.js')}}"></script>

</body>
</html>