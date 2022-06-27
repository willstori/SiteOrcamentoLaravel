@extends('admin.layout.base')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('titulo', 'Produtos')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.produtos') }}">Produtos</a></li>
    <li class="breadcrumb-item active">Editar</li>

@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Editar</h3>

            <hr />

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.produtos.edit', $produto->id) }}">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:;">Fotos</a>
                </li>
            </ul>

            <h4>Foto - Principal</h4>

            <hr />

            <div>
                <img src="{{ $produto->foto_thumb }}" style="max-width: 100%; width: auto; height: auto;" />
            </div>

            <hr />

            <h4>Fotos - Galeria</h4>

            <hr />

            <div class="ordenavel row" data-rota="{{route('admin.produtos.orderProdutoFoto')}}">

                @foreach ($produto->fotos as $produtoFoto)
                    <div class="col-2 my-1" data-id="{{ $produtoFoto->id }}">
                        <img src="{{ $produtoFoto->foto_thumb }}" class="rounded"
                            style="max-width: 100%; width: auto; height: auto;" />
                        <button class="handle btn btn-secondary"><i class="fa fa-arrows"></i></button>
                        <button class="btn btn-primary"
                            data-rota="{{ route('admin.produtos.destroyProdutoFoto', $produtoFoto->id) }}"
                            data-id="{{ $produtoFoto->id }}" onclick="crudHelper.Remover(this)"><i
                                class="fa fa-trash"></i></button>
                    </div>
                @endforeach
            </div>

            <hr />

            <form class="row g-3" action="{{ route('admin.produtos.updateFotos', $produto->id) }}" method="post"
                enctype="multipart/form-data">

                @csrf

                @method("PUT")

                <div class="col-md-6">
                    <label for="foto" class="form-label">Foto Principal ( jpg, png, gif ) 800x600</label>
                    <input id="foto" class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="fotos" class="form-label">Fotos Galeria( jpg, png, gif ) 800x600</label>
                    <input id="fotos" class="form-control @error('fotos') is-invalid @enderror" type="file" name="fotos[]"
                        multiple>
                    @error('fotos')
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
    <script src="admin/js/plugins/sortable.js"></script>
    <script src="admin/js/crud-helper.js?v=2"></script>

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
