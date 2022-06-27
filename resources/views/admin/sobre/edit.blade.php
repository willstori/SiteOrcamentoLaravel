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
                    <a class="nav-link active" aria-current="page" href="javascript:;">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.sobre.fotos', $sobre->id) }}">Fotos</a>
                </li>
            </ul>

            <form class="row g-3" action="{{ route('admin.sobre.update', $sobre->id) }}" method="post">

                @csrf

                @method("PUT")

                <div class="form-group col-md-12">
                    <label for="texto" class="form-label">Texto</label>
                    <textarea id="texto" name="texto" class="form-control @error('texto') is-invalid @enderror" rows="10">{{ $sobre->texto }}</textarea>
                    @error('texto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="missao" class="form-label">Missão</label>
                    <textarea id="missao" name="missao" class="form-control @error('missao') is-invalid @enderror" rows="5">{{ $sobre->missao }}</textarea>
                    @error('missao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="visao" class="form-label">Visão</label>
                    <textarea id="visao" name="visao" class="form-control @error('visao') is-invalid @enderror" rows="5">{{ $sobre->visao }}</textarea>
                    @error('visao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="valores" class="form-label">Valores</label>
                    <textarea id="valores" name="valores" class="form-control @error('valores') is-invalid @enderror" rows="5">{{ $sobre->valores }}</textarea>
                    @error('valores')
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
