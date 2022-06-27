@extends('admin.layout.base')

@section('titulo', 'Produtos')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.produtos') }}">Produtos</a></li>
    <li class="breadcrumb-item active">Cadastrar</li>

@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Cadastrar</h3>

            <hr>

            <form class="row g-3" action="{{ route('admin.produtos.store') }}" method="post"
                enctype="multipart/form-data">

                @csrf

                <div class="form-group col-md-6 @error('id_categoria') has-danger @enderror">
                    <label for="id_categoria" class="form-label">Categoria</label>
                    <select name="id_categoria" class="form-control" onchange="getSubcategorias(this)">
                        <option value="">Selecione:</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{route('admin.subcategorias.getSubcategorias', $categoria->id)}}">{{$categoria->nome}}</option>
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
                    </select>
                    @error('id_subcategoria')
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

                <div class="form-group col-md-3 @error('codigo') has-danger @enderror">
                    <label for="codigo" class="form-label">Código</label>
                    <input id="codigo" class="form-control @error('codigo') is-invalid @enderror" type="text" name="codigo"
                        value="{{ old('codigo') }}">
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3 @error('valor') has-danger @enderror">
                    <label for="valor" class="form-label">Valor</label>
                    <input id="valor" class="form-control @error('valor') is-invalid @enderror" type="text" name="valor"
                        value="{{ old('valor') }}">
                    @error('valor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group col-md-12">
                    <label for="texto" class="form-label">Texto</label>
                    <textarea id="texto" class="form-control @error('texto') is-invalid @enderror" rows="10" name="texto">{{ old('texto') }}</textarea>
                    @error('texto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="foto" class="form-label">Foto Principal( jpg, png, gif ) 800x600</label>
                    <input id="foto" class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="fotos" class="form-label">Fotos Galeria( jpg, png, gif ) 800x600</label>
                    <input id="fotos" class="form-control @error('fotos') is-invalid @enderror" type="file" name="fotos[]" multiple>
                    @error('fotos')
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
@section('pageScripts')
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
