@extends('admin.layout.base')

@section('titulo', 'Usuários')

@section('caminho')
    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Usuários</a></li>
    <li class="breadcrumb-item active">Cadastrar</li>
@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Cadastrar</h3>

            <hr>

            <form class="row g-3" action="{{ route('admin.users.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="col-6">
                    <label for="name" class="form-label">Nome</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="text"
                        name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg mx-1">Cadastrar</button>
                    <button type="button" class="btn btn-secondary btn-lg mx-1"
                        onclick="javascript:history.back()">Voltar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
