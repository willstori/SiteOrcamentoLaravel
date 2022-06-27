@extends('site.layout.base')

@section('headPagina')
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection

@section('conteudo')
    <section class="container" id="headerPage">
        <h1 class="four-color main-t">CARRINHO</h1>
    </section>
    <!-- modelo de bloco da página -->
    <section class="container content-page bg-one flex_c">

        @if(!empty($itens))
        <!-- produtos no carrinho mostrar o código abaixo -->
        <div class="main flex_c">
            <ul class="my_cart">
                @foreach ($itens as $item)
                <li class="flex_r flex_w" data-id="{{$item['produto']->id}}">
                    <aside class="cart_produto flex_r">
                        <figure>
                            <img src="{{$item['produto']->foto_thumb}}" alt="{{$item['produto']->nome}}" title="{{$item['produto']->nome}}" />
                        </figure>
                        <hgroup>
                            <h6 class="sub-t second-color">{{$item['produto']->nome}}</h6>
                            <h6 class="code-prod second-color">Cod: {{$item['produto']->codigo}}</h6>
                        </hgroup>
                    </aside>

                    <div class="quantidadeProd flex middle">
                        <form action="javascript:;" id="formQuantidade" class="formQuantidade flex flex_r middle">
                            <button class="bMinus borisB" onclick="carrinho.Decrementar(this)">-</button>
                            <input type="number" class="quantidade" name="quantidade" value="{{$item['quantidade']}}" onblur="carrinho.Editar(this)" />
                            <button class="bPlus borisB" onclick="carrinho.Incrementar(this)">+</button>
                        </form>
                        <button class="remove button borisB flex middle" onclick="carrinho.Remover(this)">X</button>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="wrap-buttons">
                <a href="{{route('produtos')}}" class="button bg-five third-color"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;ADICIONAR MAIS</a>
                <a href="{{route('carrinho.finalizar')}}" class="button bg-three four-color"><i class="far fa-check-square"></i>&nbsp;&nbsp;&nbsp;CONCLUIR ORÇAMENTO</a>
                <a href="javascript:;" class="pedirWpp button bg-green four-color flex middle"><i class="fab fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;PEDIR POR WHATSAPP</a>
            </div>
        </div>
        <!-- finalizar código com produto -->
        @else
        <!-- nenhum produto selecionado mostrar o código abaixo -->
        <div class="main flex_c">
            <h1 class="sub-t second-color t-center no-products">
                <i class="fas fa-exclamation-triangle"></i>
                <br />
                NENHUM PRODUTO ADICIONADO AO CARRINHO
            </h1>
        </div>
        <!-- finalizar código sem produto -->
        @endif

    </section>

    <section class="finalizarWpp container">
        <div class="main flex_c middle">
            <button class="closeFancy">X</button>

            <h6 class="sub-t second-color">PEDIR POR WHATSAPP</h6>

            <form id="form_contact" action="javascript:;" method="post">

                <input type="text" name="nome" id="nome" class="input" placeholder="Nome:" required>

                <input type="email" name="email" id="email" class="input" placeholder="E-mail:" required>

                <button type="submit" class="button bg-three four-color btn-r">FINALIZAR</button>
            </form>
        </div>
    </section>
@endsection

@section('scriptsPagina')
<script src="site/js/carrinho.js?v=9"></script>
<script>
    const carrinho = new Carrinho();
    $('.pedirWpp').click(function(){
        $('.finalizarWpp').addClass('showF');
    });

    $('.closeFancy').click(function(){
        $('.finalizarWpp').removeClass('showF');
    });
</script>
@endsection
