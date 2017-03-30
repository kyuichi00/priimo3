<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Priima') }}</title>
        <link href="/css/app.css" rel="stylesheet">
        <link rel="shortcut icon" href="{{(asset('images/smile.png'))}}">
        {!! Html::style(asset('css/app.css')) !!}
        {!! Html::style(asset('css/bootstrap.css')) !!}
        {!! Html::style(asset('css/bootstrap.min.css')) !!}
        {!! Html::style(asset('css/bootstrap-theme.css')) !!}
        {!! Html::style(asset('css/font-awesome.css')) !!}
        {!! Html::style(asset('css/font-awesome.min.css')) !!}
        {!! Html::style(asset('css/animate.css')) !!}
        {!! Html::style(asset('css/custom.css')) !!}
        {!! Html::style(asset('css/style.css')) !!}
        {!! Html::style(asset('css/dataTable/datatables.min.css')) !!}
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
        @yield('css')
        {!! Html::style(asset('css/main.css')) !!}
    </head>
    <body>
        <header id="container" class="" style="height: 60px;">
            @include('layouts.header')
        </header>
        <section class="main-section">
            @yield('content')
        </section>
        <footer id="container" class="" style="background-color: red;">
            @include('layouts.footer')
        </footer>
        {!! Html::script(asset('js/app.js')) !!}
        {!! Html::script(asset('js/bootstrap.js')) !!}
        {!! Html::script(asset('js/bootstrap.min.js')) !!}
        {!! Html::script(asset('js/jquery-3.1.1.min.js')) !!}
        {!! Html::script(asset('js/dataTable/datatables.min.js')) !!}
        @yield('script')
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
        {!! Html::script(asset('js/main.js')) !!}
    </body>
</html>