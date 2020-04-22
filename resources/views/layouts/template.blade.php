<!doctype html>
    <html lang="nl">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
            @yield('css_after')
            <title>@yield('title', 'Hotel Kempenrust')</title>

            <meta name="csrf-token" content="{{ csrf_token() }}">

            <link rel="icon" type="image/png" sizes="32x32" href="/assets/Icons/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/assets/Icons/favicon-16x16.png">
            <link rel="manifest" href="/assets/Icons/site.webmanifest">
            <meta name="msapplication-TileColor" content="#00aba9">
            <meta name="theme-color" content="#ffffff">
        </head>
        <body class="body d-flex flex-column min-vh-100">

            @include('shared.navigation')
            <main class="container-sm mt-3 p-4 ">
                @yield('main')
            </main>

            <footer>
            @include('shared.footer')
            </footer>
    <script src="{{ mix('js/app.js') }}">    </script>
    @yield('script_after')

    @if(env('APP_DEBUG'))
        <script>
            $('form').attr('novalidate', 'true');

            $(function () {
                //Overlay for help
                $('#openHelp').click(function () {
                    $('#MyDiv').css('transform', 'scale(1)');
                });
                $('#closeHelp').click(function () {
                    $('#MyDiv').css('transform', 'scale(0)');
                });
            })
        </script>
    @endif

        </body>
</html>
