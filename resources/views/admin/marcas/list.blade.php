@extends('admin.layout.base')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('titulo', 'Marcas')

@section('caminho')
    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item active">Marcas</li>
@endsection

@section('conteudo')

    <div class="col-12">
        <div class="tile">
            <h3>Listagem</h3>

            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <button class="btn btn-primary" type="button"
                                onclick="window.location.href='{{ route('admin.marcas.create') }}'">Novo Marca</button>

                        </th>
                        <th>Nome</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody class="ordenavel" data-rota="{{ route('admin.marcas.order') }}">
                    @foreach ($marcas as $marca)
                        <tr data-id="{{ $marca->id }}">
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="handle btn btn-secondary"><i class="fa fa-arrows"></i></button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="window.location.href='{{ route('admin.marcas.edit', $marca->id) }}'">Editar</button>
                                    <button type="button" class="btn btn-danger" onclick="remover(this)"
                                        data-id="{{ $marca->id }}"
                                        data-rota="{{ route('admin.marcas.destroy', $marca->id) }}">Remover</button>
                                </div>
                            </td>
                            <td>{{ $marca->nome }}</td>
                            <td>{{ $marca->link }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="admin/js/plugins/sortable.js"></script>
    <script src="admin/js/crud-helper.js?v=1"></script>
@endsection
