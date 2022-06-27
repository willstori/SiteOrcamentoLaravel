@extends('site.layout.base')

@section('headPagina')
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection

@section('conteudo')
    <section class="container" id="headerPage">
        <h1 class="four-color main-t">CONTATO</h1>
    </section>
    <!-- modelo de bloco da página -->
    <section class="container content-page bg-one flex_c">
        <div class="main grid2" id="page_form">
            <div class="column_form">
                <p class="second-color">Para maiores informações entre em contato utilizando nosso formulário:</p>
                <form id="form_contact" class="form-mail" data-controller="{{route('contato.email')}}" action="javascript:;">
                    <input name="check_1" type="hidden" value="">
                    <input style="position: absolute; width: 1px; top: -5000px; left: -5000px;" name="check_2" type="text">
                    <input type="text" name="nome" id="nome" class="input" placeholder="Nome Completo:" required>
                    <input type="email" name="email" id="email" class="input" placeholder="E-mail:" required>
                    <input type="text" name="telefone" id="telefone" class="input" placeholder="Telefone:" required>
                    <input type="text" name="assunto" id="assunto" class="input" placeholder="Assunto:" required>
                    <textarea id="mensagem" class="input msg" name="mensagem" placeholder="Mensagem:" required></textarea>
                    <button type="submit" class="button bg-three four-color btn-r"><i class="far fa-envelope"></i>&nbsp;&nbsp;&nbsp;&nbsp;ENVIAR MENSAGEM</button>
                </form>
            </div>
            <div class="column_form form_map">
                <iframe src="{{$site->mapa}}" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection

@section('scriptsPagina')
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
        $('#telefone').mask('(00) 00000-0000');
    </script>
@endsection
