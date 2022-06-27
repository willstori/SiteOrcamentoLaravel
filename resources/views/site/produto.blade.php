@extends('site.layout.base')

@section('headPagina')
    <link rel="stylesheet" href="site/js/navmobile/dlmenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">
    <!-- Meta tags de compartilhamento -->
    <meta property="og:locale" content="pt_BR">
    <meta property="og:url" content="{{route('produtos.detalhes', ['produto' => $produto->id, 'slug' => $produto->slug])}}">
    <meta property="og:title" content="{{$produto->nome}}">
    <meta property="og:site_name" content="Herval Embalagens">
    <meta property="og:description" content="{{$produto->texto}}">
    <meta property="og:image" content="{{ env('APP_URL') . $produto->foto }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800"> <!-- Ajustar -->
    <meta property="og:image:height" content="600"> <!-- Ajustar -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- fim Meta tags -->
@endsection

@section('conteudo')
    <section class="container" id="headerPage">
        <h1 class="four-color main-t">PRODUTOS</h1>
    </section>
    <!-- modelo de bloco da página -->
    <section class="container content-page bg-one">
        <div class="main flex_c">
            <div class="header-products flex_r flex_w">
                @include('site.includes.search')
            </div>
            <div class="flex_r flex_w" id="page_produtos">
                <nav id="menu_produtos">
                    <ul id="nav_list">
                        @include('site.includes.menuProdutos')
                    </ul>
                </nav> <!-- fim menu desktop -->
                <div id="dl-menu" class="dl-menuwrapper">
                    <button class="dl-trigger">
                        <span class="dl-chapter">CATEGORIAS</span>
                        <div class="button_container">
                            <span class="top"></span>
                            <span class="middle"></span>
                            <span class="bottom"></span>
                        </div>
                    </button>
                    <ul class="dl-menu">
                        @include('site.includes.menuProdutos')
                    </ul>
                </div>
                <section id="info_produto" class="flex_r">
                    <article class="flex_c">
                        <h6 class="sub-t second-color margin-b">{{ $produto->nome }}</h6>
                        @if (!empty($produto->codigo))
                            <span class="code-prod second-color margin-b">Cod. {{ $produto->codigo }}</span>
                        @endif

                        <!-- AddToAny BEGIN -->
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="margin-bottom:35px;">
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                            <a class="a2a_button_facebook"></a>
                            <!-- <a class="a2a_button_whatsapp"></a>                         -->
                        </div>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                        <!-- AddToAny END -->

                        <p>{!! nl2br($produto->texto) !!}</p>

                        <span class="price first-color">R$ {{ moedaBr($produto->valor) }}</span>
                        <a href="javascript:;" class="button bg-three four-color btn-l" data-rota="{{route('carrinho.adicionar')}}" data-id="{{$produto->id}}" onclick="carrinho.Adicionar(this)">
                            <!-- usar a classe ADD_CART para acionar o carrinho -->
                            <i class="fas fa-cart-plus"></i>
                            ADICIONAR AO CARRINHO
                        </a>

                    </article>
                    <aside id="slider_prod">

                        <div class="swiper-container">

                            <div class="swiper-wrapper">

                                <a href="{{ $produto->foto }}" data-fancybox="1" class="swiper-slide">
                                    <img src="{{ $produto->foto }}" alt="{{ $produto->nome }}">
                                </a>

                                @foreach ($produto->fotos as $foto)
                                    <a href="{{ $foto->foto }}" data-fancybox="1" class="swiper-slide"><img
                                            src="{{ $foto->foto_thumb }}" alt="{{ $produto->nome }}"></a>
                                @endforeach

                            </div>

                            <div class="swiper-pagination"></div>

                        </div>
                    </aside>

                </section>
            </div>
        </div>
    </section>
@endsection

@section('scriptsPagina')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js"></script>
    <script src="site/js/carrinho.js?v=3"></script>
    <script>
        const carrinho = new Carrinho();
        /* home slide */
        var swiper = new Swiper('#slider_prod .swiper-container', {
            spaceBetween: 0,
            // effect: 'fade',
            centeredSlides: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '#slider_prod .swiper-pagination',
                clickable: true,
            }
        });

        $(document).ready(function() {
            var chamada = "#nav_list li > a"; // Gatilho
            $(chamada).click(function() {
                var element = "#nav_list li";
                var alvo = $(this).parent();
                var classe = "open";

                if ($(alvo).hasClass(
                    classe)) { // verifica se já existe a classe OPEN no elemento. Se NÃO existir:
                    $(element).removeClass(classe); // remove a classe de todos os LI
                    $(alvo).find("ul").slideUp("fast"); // e fecha a UL que está aberta.
                } else { // caso contrário
                    $(element).removeClass(classe); // remove a classe de todos os LI
                    $("#nav_list li ul").slideUp(); // fecha todos os subníveis

                    $(alvo).addClass(classe); // adiciona a classe no LI pai
                    $(alvo).find("ul").stop().slideDown("fast"); // abre somente o UL filho
                }
            });
        });

        $(function() {
            $('#page_produtos #dl-menu').dlmenu({
                animationClasses: {
                    classin: 'dl-animate-in-4',
                    classout: 'dl-animate-out-4'
                }
            });

            $('#page_produtos .dl-trigger').click(function() {
                $('#page_produtos .button_container').toggleClass('active');
            });
        });
    </script>
@endsection
