<!-- Header -->
<header class="bg-one">
    <div class="main flex_r flex_w">
        <div id="logo">
            <a href="" class="logo-brand"><img src="site/img/logo-casa.png" alt="Herval Embalagens" title="Herval Embalagens" /></a>
        </div>
        <div id="header-top" class="flex_c">
            <aside id="head-links" class="flex_r flex_w">
                <nav id="menu">
                    @include('site.includes.menu')
                </nav>
                <section class="head-phone">
                    <i class="fas fa-phone first-color"></i>
                    Atendimento
                    <br />
                    <span class="sub-t first-color">{{$site->telefone}}</span>
                </section>

                @include('site.includes.social')

            </aside>
            <aside id="head-act" class="flex_r">

                @include('site.includes.search')

                <a href="carrinho" class="carrinhoHeader button bg-three four-color btn-r">
                    <i class="fas fa-cart-plus"></i>
                    CARRINHO
                </a>
            </aside>
        </div>
    </div>

    <div id="dl-menu" class="dl-menuwrapper">
        <button class="dl-trigger">
            <span class="dl-chapter">MENU</span>
            <div class="button_container">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
            </div>
        </button>
        @include('site.includes.menu')
    </div>
</header>
<!-- Fim Header -->
