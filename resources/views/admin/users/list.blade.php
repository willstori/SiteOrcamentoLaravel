@extends('admin.layout.base')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('titulo', 'Usuários')

@section('caminho')
    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item active">Usuários</li>
@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Cadastrar</h3>

            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><button class="btn btn-primary" type="button"
                                onclick="window.location.href='{{ route('admin.users.create') }}'">Novo Usuário</button>
                        </th>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary"
                                        onclick="window.location.href='{{ route('admin.users.edit', $user->id) }}'">Editar</button>
                                    <button type="button" class="btn btn-danger" onclick="remover(this)"
                                        data-id="{{ $user->id }}"
                                        data-rota="{{ route('admin.users.destroy', $user->id) }}">Remover</button>
                                </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function remover(el) {
            Swal.fire({
                icon: 'error',
                title: 'Atenção',
                text: 'Você realmente deseja Excluir este Item?',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const button = $(el);
                    $.ajax({
                        type: "delete",
                        url: button.data('rota'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            user: button.data('id')
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.tipo == "success") {
                                location.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
