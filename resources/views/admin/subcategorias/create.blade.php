@extends('admin.layout.base')

@section('titulo', 'Subcategorias')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.subcategorias') }}">Subcategorias</a></li>
    <li class="breadcrumb-item active">Cadastrar</li>

@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Cadastrar</h3>

            <hr>

            <form class="row g-3" action="{{ route('admin.subcategorias.store') }}" method="post"
                enctype="multipart/form-data">

                @csrf

                <div class="form-group col-md-6 @error('nome') has-danger @enderror">
                    <label for="nome" class="form-label">Categoria</label>
                    <select name="id_categoria" class="form-control @error('id_categoria') is-invalid @enderror">
                        <option value="">Selecione:</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ $categoria->id == old('id_categoria') ? 'selected' : null }}>{{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 @error('nome') has-danger @enderror">
                    <label for="nome" class="form-label">Nome</label>
                    <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome"
                        value="{{ old('nome') }}">
                    @error('nome')
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
