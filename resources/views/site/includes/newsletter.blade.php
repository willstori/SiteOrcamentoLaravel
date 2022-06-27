<section class="newsletter container">
    <div class="main flex_r flex_w middle">
        <div class="formNews flex middle">
            <h3 class="main-t whiteFont uppercase bold">Newsletter</h3>

            <form id="form_news" class="flex_r flex_w form-mail" action="javascript:;" data-controller="newsletter" >

                <input type="text" name="nome" class="input e_input" placeholder="Nome" required>
                <input type="email" name="email" class="input e_input" placeholder="E-mail" required>

                <button type="submit" class="button">OK</button>

            </form>
        </div>

        <div class="telNews flex middle">
            <img src="assets/site/img/telH.png">

            <p class="uppercase">Atendimento<br>
            <a class="bold">{{$site->telefone}}</a>
            </p>
        </div>
    </div>
</section>
