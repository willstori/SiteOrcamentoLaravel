<footer class="flex_c">
    <div class="main flex_c">
        <section class="box-footer flex_r flex_w">

            <!-- Newsletter -->
            <aside class="box-newsletter flex_r">
                <h6 class="main-t four-color">NEWSLETTER</h6>
                <form class="flex_r flex_w form-mail" id="form_news" data-controller="newsletter" action="javascript:;">
                    <input type="text" name="nome" placeholder="Nome:" class="input" autocomplete="off">
                    <input type="email" name="email" placeholder="E-mail:" class="input" autocomplete="off">
                    <input type="submit" name="button" class="btn-send first-color" value="OK">
                </form>
            </aside>
            <!-- Fim Newsletter -->

            <section class="head-phone">
                <i class="fas fa-phone four-color"></i>
                Atendimento
                <br />
                <span class="sub-t four-color">{{$site->telefone}}</span>
            </section>

            @include('site.includes.social')

        </section>

        <section class="box-footer flex_r flex_w">

            <nav id="menu_footer">
                @include('site.includes.social')
            </nav>

            <address class="box-endereco">
                <i class="fas fa-map-marker-alt four-color"></i>
                <p class="four-color">
                    {!!nl2br($site->endereco)!!}
                </p>
            </address>

            <aside class="box-mail">
                <i class="far fa-envelope four-color"></i>
                <a href="mailto:{{$site->email}}" class="four-color">{{$site->email}}</a>
            </aside>

        </section>
    </div>
    <div id="development">
        <div class="main flex_r">
            <span class="four-color">&copy; 2020 - Todos os direitos reservados</span>
            <span class="four-color">
                <a href="admin" class="four-color">Acesso Restrito</a> - <a href="http://webmail.lovatelweb.com.br"
                    target="_blank" class="four-color">Webmail</a> - Feito por <a href="https://www.lovatel.com.br/"
                    target="_blank" class="four-color">Lovatel Agência Lovatel</a>
            </span>
        </div>
    </div>
</footer>

<div class="pluginWpp">
    <p><span>Podemos ajudar?</span></p>
    <a href="javascript:;" target="" class="whatsChat"></a>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="site/js/navmobile/modernizr.custom.js"></script>
<script src="site/js/navmobile/jquery.dlmenu.js"></script>
<script src="https://lovatel.com.br/plugins/whatsChat.js"></script>
<!-- Não remover -->
<script src="admin/js/plugins/sweetalert2.all.min.js"></script>
<script src="site/js/main.js?v=1"></script>
<!-- Não remover -->
<script>
    /* WHATSAPP BUTTON */
    $(document).ready(function() {
        $("#whatsButton").whatsChat({
            number: '49999999999',
            message: 'Olá, tudo bem? Estava navegando no site www.hervalembalagens.com.br e gostaria de mais informações.',
            position: 'wRight', // wRight, wrightMiddle, wRightTop ou wLeft
            target: '_blank'
        });
    });

    $(function () {
        $('header #dl-menu').dlmenu({
            animationClasses: {classin: 'dl-animate-in-4', classout: 'dl-animate-out-4'}
        });

        $('header .dl-trigger').click(function () {
            $('header .button_container').toggleClass('active');
        });
    });

</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-163056489-32"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-163056489-32');
</script>
