@extends('admin.layout.base')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('titulo', 'Subcategorias')

@section('caminho')
    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item active">Subcategorias</li>
@endsection

@section('conteudo')

    <div class="col-12">
        <div class="tile">
            <h3>Listagem</h3>
            <hr>

            <form class="form-inline d-flex justify-content-end" action="{{route('admin.subcategorias.search')}}" method="get">
                <input type="text" class="form-control mb-2 mr-sm-2" name="busca" placeholder="Digite sua Busca:">
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <button class="btn btn-primary" type="button"
                                onclick="window.location.href='{{ route('admin.subcategorias.create') }}'">Nova Subcategoria</button>
                        </th>
                        <th>Categoria</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody class="ordenavel" data-rota="{{ route('admin.subcategorias.order') }}">
                    @foreach ($subcategorias as $subcategoria)
                        <tr data-id="{{ $subcategoria->id }}">
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="handle btn btn-secondary"><i class="fa fa-arrows"></i></button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="window.location.href='{{ route('admin.subcategorias.edit', $subcategoria->id) }}'">Editar</button>
                                    <button type="button" class="btn btn-danger" onclick="crudHelper.Remover(this)"
                                        data-id="{{ $subcategoria->id }}"
                                        data-rota="{{ route('admin.subcategorias.destroy', $subcategoria->id) }}">Remover</button>
                                </div>
                            </td>
                            <td>{{ $subcategoria->categoria->nome }}</td>
                            <td>{{ $subcategoria->nome }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <nav class="d-flex justify-content-end">
                {{$subcategorias->appends(['busca' => isset($busca) ? $busca : ''])->links()}}
            </nav>

        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="admin/js/plugins/sortable.js"></script>
    <script src="admin/js/crud-helper.js?v=1"></script>
@endsection
