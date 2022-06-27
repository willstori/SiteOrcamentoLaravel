@extends('site.layout.base')

@section('conteudo')
    <section class="container" id="headerPage">
        <h1 class="four-color main-t">HERVAL EMBALAGENS</h1>
    </section>
    <!-- modelo de bloco da página -->
    <section class="container content-page bg-one">
        <div class="main flex_r flex_w about-page">

            <article>
                <p>{!!nl2br($sobre->texto)!!}</p>

                <h6 class="sub-t second-color margin-b">MISSÃO</h6>
                <p>{!!nl2br($sobre->missao)!!}</p>
                <br />

                <h6 class="sub-t second-color margin-b">VISÃO</h6>
                <p>{!!nl2br($sobre->visao)!!}</p>
                <br />

                <h6 class="sub-t second-color margin-b">VALORES</h6>
                <p>{!!nl2br($sobre->valores)!!}</p>
                <br />
            </article>

            <article>
                <section id="banner">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="{{$sobre->foto}}" alt="Herval Embalagens"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </section>
            </article>

        </div>
    </section>
@endsection

@section('scriptsPagina')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>
<script>
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
</script>
@endsection
