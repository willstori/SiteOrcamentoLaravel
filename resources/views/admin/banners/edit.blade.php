@extends('admin.layout.base')

@section('titulo', 'Banners')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.banners') }}">Banners</a></li>
    <li class="breadcrumb-item active">Editar</li>

@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Editar</h3>

            <hr />

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="javascript:;">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.banners.fotos', $banner->id) }}">Fotos</a>
                </li>
            </ul>

            <form class="row g-3" action="{{ route('admin.banners.update', $banner->id) }}" method="post">

                @csrf

                @method("PUT")

                <div class="form-group col-md-6">
                    <label for="titulo" class="form-label">Título</label>
                    <input id="titulo" class="form-control @error('titulo') is-invalid @enderror" type="text" name="titulo"
                        value="{{ $banner->titulo }}">
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="link" class="form-label">Link</label>
                    <input id="link" class="form-control @error('link') is-invalid @enderror" type="url" name="link"
                        value="{{ $banner->link }}">
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12"><hr></div>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
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
