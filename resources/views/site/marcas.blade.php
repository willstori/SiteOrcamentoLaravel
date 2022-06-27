@extends('site.layout.base')

@section('conteudo')
    <section class="container" id="headerPage">
        <h1 class="four-color main-t">MARCAS</h1>
    </section>

    <section class="container content-page bg-one marcas">
        <div class="main grid4">
            @foreach ($marcas as $marca)
            <a href="{{$marca->link}}" target="_blank" class="flex middle">
                <img src="{{$marca->foto}}" alt="{{$marca->nome}}" title="{{$marca->nome}}">
            </a>
            @endforeach
        </div>
    </section>
@endsection
