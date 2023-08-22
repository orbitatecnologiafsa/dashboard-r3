<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="https://orbitadashboard.azurewebsites.net/img/orbita-icon.png">
    <link rel="icon" type="image/png" href="https://orbitadashboard.azurewebsites.net/img/orbita-icon.png">
    <title>
        @yield('titulo')
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://orbitadashboard.azurewebsites.net/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://orbitadashboard.azurewebsites.net/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://orbitadashboard.azurewebsites.net/css/argon-dashboard.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://orbitadashboard.azurewebsites.net/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="https://orbitadashboard.azurewebsites.net/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>




</head>

@if (auth()->hasUser() && session()->get('cnpj_loja'))

    <body class="g-sidenav-show   bg-gray-100">

        @stack('sidbar')
        <main class="main-content position-relative border-radius-lg ">
            @stack('navbar')
            @yield('conteudo')
        </main>


        @include('tamplate.javascript')

        @stack('javascript')
        @include('tamplate.msg')
    </body>
@elseif (auth('admin')->hasUser())

    <body class="g-sidenav-show   bg-gray-100">

        @stack('sidbar')
        <main class="main-content position-relative border-radius-lg ">
            @stack('navbar')
            @yield('conteudo')
        </main>


        @include('tamplate.javascript')
        <script src="https://orbitadashboard.azurewebsites.net/js/adm/dashboard.js"></script>
        <script>
            nav_info_adm("{{ route('adm-contador-clientes') }} ");
        </script>
        @stack('javascript')

        @include('tamplate.msg')
    </body>
@else

    <body>
        @yield('conteudo')

        @include('tamplate.javascript')
        <script src="https://orbitadashboard.azurewebsites.net/js/senha/exibir-senha.js'"></script>
        @include('tamplate.msg')
    </body>
@endif



</html>
