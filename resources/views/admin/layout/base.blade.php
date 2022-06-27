<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <base href="{{ env('APP_URL') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Meta tags -->
    @yield('meta')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="admin/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('links')
    <title>@yield('titulo') - Admin Laravel</title>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="admin">
        <img src="https://www.lovatel.com.br/img/logo-cp2.png" alt="Lovatel Agência Digital" height="30"/>
    </a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
            aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"
                    aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="{{route('admin.users')}}"><i class="fa fa-users"></i> Usuários</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.users.edit', Auth::user()->id)}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    @include('admin.layout.includes.menuLateral')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> @yield('titulo')</h1>
                <p>@yield('descricao')</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                @yield('caminho')
            </ul>
        </div>
        <div class="row">
            @yield('conteudo')
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="admin/js/jquery-3.3.1.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="admin/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="admin/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    @yield('pageScripts')
</body>

</html>
