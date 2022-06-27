@extends('site.layout.base')

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

                @if(!$produtos->isEmpty())

                <ul class="list-products grid4">

                    @foreach ($produtos as $produto)

                    <li class="box-list-products">
                        <a href="{{route('produtos.detalhes', ['produto' => $produto->id, 'slug' => $produto->slug])}}" class="flex_c">
                            <img src="{{ $produto->foto_thumb }}" alt="{{ $produto->nome }}" />
                            <!--230x300-->
                            <h6 class="sub-t second-color">{{ $produto->nome }}</h6>
                            @if(!empty($produto->codigo))
                            <span class="code-prod second-colors">Cod. {{ $produto->codigo }}</span>
                            @endif
                        </a>
                    </li>

                    @endforeach

                </ul>

                @else

                <h1 class="sub-t second-color t-center no-products">
                    <i class="fas fa-exclamation-triangle"></i>
                    <br />
                    NENHUM PRODUTO ENCONTRADO
                </h1>
                <div class="wrap_page page_products">
                   <!-- Paginação -->
                </div>

                @endif

            </div>
        </div>
    </section>
@endsection

@section('scriptsPagina')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>

<script>
    $(document).ready(function () {
        var chamada = "#nav_list li > a"; // Gatilho
        $(chamada).click(function () {
            var element = "#nav_list li";
            var alvo = $(this).parent();
            var classe = "open";

            if ($(alvo).hasClass(classe)) { // verifica se já existe a classe OPEN no elemento. Se NÃO existir:
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

    $(function () {
        $('#page_produtos #dl-menu').dlmenu({
            animationClasses: {classin: 'dl-animate-in-4', classout: 'dl-animate-out-4'}
        });

        $('#page_produtos .dl-trigger').click(function () {
            $('#page_produtos .button_container').toggleClass('active');
        });
    });

</script>
@endsection
