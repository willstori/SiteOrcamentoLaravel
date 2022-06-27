@extends('site.layout.base')

@section('conteudo')

    <section class="container" id="wrap-banner">
        <section id="banner">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                    <div class="swiper-slide lazy-img">
                        <a href="{{$banner->link}}" target="_blank">
                            <img data-url="{{$banner->foto}}">
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    </section>

    <!-- modelo de bloco da página -->
    <section class="container content-page bg-one">
        <div class="main flex_c">
            <div class="header-products flex_r flex_w">
                <h1 class="main-t first-color">PRODUTOS</h1>
                @include('site.includes.search')
            </div>

            <ul class="list-products grid5">
                @foreach ($produtos as $produto)
                <li class="box-list-products">
                    <a href="{{route('produtos.detalhes', ['produto' => $produto->id, 'slug' => $produto->slug])}}" class="flex_c">
                        <img src="{{$produto->foto_thumb}}" alt="{{$produto->nome}}" />
                        <!--230x300-->
                        <h6 class="sub-t second-color">{{$produto->nome}}</h6>
                       @if (!empty($produto->codigo))
                       <span class="code-prod second-colors">Cod. {{$produto->codigo}}</span>
                       @endif
                    </a>
                </li>
                @endforeach
            </ul>

            <a href="produtos" class="button no-bg first-color">VER MAIS PRODUTOS</a>

        </div>
    </section>
@endsection

@section('scriptsPagina')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>
    <script>
        $("#mainpop").addClass("show");
        $(".modal_close").click(function() {
            $("#mainpop").removeClass("show");
        });

        /* home slide */
        var swiper = new Swiper('#banner .swiper-container', {
            spaceBetween: 0,
            effect: 'fade',
            centeredSlides: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '#banner .swiper-pagination',
                clickable: true,
            }
        });

        var swiper = new Swiper('#slider-brands .swiper-container', {
            slidesPerView: 5,
            spaceBetween: 60,
            slidesPerGroup: 1,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '#slider-brands .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                1050: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                750: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                750: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                    slidesPerGroup: 2,
                },
                610: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    slidesPerGroup: 1,
                }
            }
        });
    </script>

@endsection
