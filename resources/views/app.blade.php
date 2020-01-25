<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amatis Assessment</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
</head>
<body>
<div id="app" class="container">

    <h1 class="mt-5 text-center">Amatis Shopping Cart Assessment</h1>
    <div class="row justify-content-start">
        <div class="col-8 mt-5 mx-auto">
            <product-list></product-list>
        </div>
        <div class="col-4 mt-5 mx-auto">
            <cart></cart>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
