<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li><a class="app-menu__item {{ Request::routeIs('admin.inicio') ? 'active' : null }}" href="{{route('admin.inicio')}}"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label"> Início</span></a></li>
        <li><a class="app-menu__item {{ Request::routeIs('admin.banners*') ? 'active' : null }}" href="{{route('admin.banners')}}"><i class="app-menu__icon fa fa-picture-o"></i><span class="app-menu__label"> Banners</span></a></li>
        <li class="treeview {{ Request::routeIs('admin.categorias*') || Request::routeIs('admin.subcategorias*') || Request::routeIs('admin.produtos*') ? 'is-expanded' : null }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cube"></i><span class="app-menu__label">Produtos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item {{ Request::routeIs('admin.categorias*') ? 'active' : null }}" href="{{route('admin.categorias')}}"><i class="icon fa fa-circle-o"></i> Categorias</a></li>
                <li><a class="treeview-item {{ Request::routeIs('admin.subcategorias*') ? 'active' : null }}" href="{{route('admin.subcategorias')}}"><i class="icon fa fa-circle-o"></i> Subcategorias</a></li>
                <li><a class="treeview-item {{ Request::routeIs('admin.produtos*') ? 'active' : null }}" href="{{route('admin.produtos')}}"><i class="icon fa fa-circle-o"></i> Produtos</a></li>
            </ul>
        </li>
        <li><a class="app-menu__item {{ Request::routeIs('admin.marcas*') ? 'active' : null }}" href="{{route('admin.marcas')}}"><i class="app-menu__icon fa fa-tag"></i><span class="app-menu__label"> Marcas</span></a></li>
        <li><a class="app-menu__item {{ Request::routeIs('admin.sobre*') ? 'active' : null }}" href="{{route('admin.sobre.edit', 1)}}"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label"> Sobre</span></a></li>
        <li><a class="app-menu__item {{ Request::routeIs('admin.site*') ? 'active' : null }}" href="{{route('admin.site.edit', 1)}}"><i class="app-menu__icon fa fa-globe"></i><span class="app-menu__label"> Site</span></a></li>
    </ul>
</aside>
