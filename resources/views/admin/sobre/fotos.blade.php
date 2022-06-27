@extends('admin.layout.base')

@section('titulo', 'Sobre')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Sobre</a></li>
    <li class="breadcrumb-item active">Editar</li>

@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Editar</h3>

            <hr />

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.sobre.edit', $sobre->id) }}">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:;">Fotos</a>
                </li>
            </ul>

            <h4>Foto - Principal</h4>

            <hr />

            <div>
                <img src="{{ $sobre->foto }}" style="max-width: 100%; width: auto; height: auto;" />
            </div>

            <hr />

            <form class="row g-3" action="{{ route('admin.sobre.updateFotos', $sobre->id) }}" method="post"
                enctype="multipart/form-data">

                @csrf

                @method('PUT')

                <div class="col-md-6">
                    <label for="foto" class="form-label">Foto ( jpg, png, gif ) 800x600</label>
                    <input id="foto" class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <hr>
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
