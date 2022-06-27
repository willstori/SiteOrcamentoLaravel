@extends('admin.layout.base')

@section('titulo', 'Marcas')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.marcas') }}">Marcas</a></li>
    <li class="breadcrumb-item active">Cadastrar</li>

@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Cadastrar</h3>

            <hr>

            <form class="row g-3" action="{{ route('admin.marcas.store') }}" method="post"
                enctype="multipart/form-data">

                @csrf

                <div class="form-group col-md-6 @error('nome') has-danger @enderror">
                    <label for="nome" class="form-label">Nome</label>
                    <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome"
                        value="{{ old('nome') }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="link" class="form-label">Link</label>
                    <input id="link" class="form-control @error('link') is-invalid @enderror" type="url" name="link"
                        value="{{ old('link') }}">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="foto" class="form-label">Foto ( jpg, png, gif ) 300x200</label>
                    <input id="foto" class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <hr>
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
