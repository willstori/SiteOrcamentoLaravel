@extends('admin.layout.base')

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
                    <a class="nav-link active" aria-current="page" href="javascript:;">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.produtos.fotos', $produto->id) }}">Fotos</a>
                </li>
            </ul>

            <form class="row g-3" action="{{ route('admin.produtos.update', $produto->id) }}" method="post">

                @csrf

                @method("PUT")

                <div class="form-group col-md-6 @error('id_categoria') has-danger @enderror">
                    <label for="id_categoria" class="form-label">Categoria</label>
                    <select class="form-control" onchange="getSubcategorias(this)">
                        <option value="">Selecione:</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{route('admin.subcategorias.getSubcategorias', $categoria->id)}}"
                                 {{$produto->subcategoria->id_categoria == $categoria->id ? "selected" : null}}>{{$categoria->nome}}</option>
                        @endforeach
                    </select>
                    @error('id_categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 @error('id_subcategoria') has-danger @enderror">
                    <label for="id_subcategoria" class="form-label">Subcategoria</label>
                    <select id="id_subcategoria" class="form-control @error('id_subcategoria') is-invalid @enderror" name="id_subcategoria" >
                        <option value="">Selecione:</option>
                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{$subcategoria->id}}" {{$subcategoria->id == $produto->id_subcategoria ? "selected" : null}}>{{$subcategoria->nome}}</option>
                        @endforeach
                    </select>
                    @error('id_subcategoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 @error('nome') has-danger @enderror">
                    <label for="nome" class="form-label">Nome</label>
                    <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome"
                        value="{{ $produto->nome }}">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3 @error('codigo') has-danger @enderror">
                    <label for="codigo" class="form-label">Código</label>
                    <input id="codigo" class="form-control @error('codigo') is-invalid @enderror" type="text" name="codigo"
                        value="{{ $produto->codigo }}">
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3 @error('valor') has-danger @enderror">
                    <label for="valor" class="form-label">Valor</label>
                    <input id="valor" class="form-control @error('valor') is-invalid @enderror" type="text" name="valor"
                        value="{{ $produto->valor }}">
                    @error('valor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group col-md-12">
                    <label for="texto" class="form-label">Texto</label>
                    <textarea id="texto" class="form-control @error('texto') is-invalid @enderror" rows="10" name="texto">{{ $produto->texto }}</textarea>
                    @error('texto')
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
    <script>
        function getSubcategorias(el){
            var select = $(el);
            $.ajax({
                type: "GET",
                url: select.val(),
                dataType: "json",
                beforeSend: function(){
                    $('#id_subcategoria').html('<option value="">Selecione:</option>');
                },
                success: function (response) {
                    for(var i = 0; i < response.length; i++){
                        $('#id_subcategoria').append(`
                            <option value="`+response[i].id+`">`+response[i].nome+`</option>
                        `);
                    }
                },
                error: function(reject){
                    if(reject.status == 404){
                        console.log('Nenhuma Subcategoria encontrada.');
                    }
                }
            });
        }
    </script>
@endsection
