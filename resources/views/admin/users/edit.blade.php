@extends('admin.layout.base')

@section('titulo', 'Usuários')

@section('caminho')
    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Usuários</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Edit</h3>

            <hr>
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="javascript:;">Dados</a>
                </li>
            </ul>
            <form class="row g-3" action="{{ route('admin.users.update', $user->id) }}" method="post">
                @csrf
                @method("PUT")
                <div class="col-6">
                    <label for="name" class="form-label">Nome</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        value="{{ $user->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                        value="{{ $user->email }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="text"
                        name="password" value="">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg mx-1">Alterar</button>
                    <button type="button" class="btn btn-secondary btn-lg mx-1"
                        onclick="javascript:history.back()">Voltar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('pageScripts')
    @if (session('success'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: "success",
                title: "Sucesso!",
                text: "{{ session('success') }}",
                timer: 3000
            });
        </script>
    @endif
@endsection
