<html lang="pt-br">

<head>
    @include('site.includes.head')

    @yield('headPagina')
</head>

<body>

    @include('site.includes.header')

    @yield('conteudo')

    @include('site.includes.footer')

    @yield('scriptsPagina')

</body>

</html>
