<!DOCTYPE html>
<html>

<head>
    <base href="{{ env('APP_URL') }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="admin/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Vali Admin</title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Admin Laravel</h1>
        </div>
        <div class="login-box">

            <form id="login" class="login-form" action="javascript:;" data-rota="{{ route('admin.auth') }}">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>LOGIN</h3>
                <div class="form-group">
                    <label class="control-label">E-MAIL</label>
                    <input class="form-control" type="text" name="email" placeholder="E-mail" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">SENHA</label>
                    <input class="form-control" type="password" name="password" placeholder="Senha">
                </div>
                <div class="form-group">
                    <div class="utility">
                        <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Esqueceu a senha ?</a></p>
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>ENTRAR</button>
                </div>
            </form>

            <form id="fotgot-password" class="forget-form" action="javascript:;" data-rota="{{ route('admin.forgot') }}">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Esqueceu a senha ?</h3>
                <div class="form-group">
                    <label class="control-label">E-MAIL</label>
                    <input class="form-control" type="text" name="email" placeholder="Email">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Alterar</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>
                            Voltar para Login</a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="admin/js/jquery-3.3.1.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="admin/js/plugins/pace.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
    <script>
        $(document).on('submit', '#login', function() {

            const form = $(this);

            $.ajax({
                type: "POST",
                url: form.data('rota'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form.serialize(),
                dataType: "json",
                success: function(response) {
                    window.location.href = response.rota;
                },
                error: function(reject) {

                    var responseJson = $.parseJSON(reject.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Atenção!",
                        text: responseJson.errors,
                        timer: 3000
                    });

                }
            });

        });

        $(document).on('submit', '#fotgot-password', function() {

            const form = $(this);

            $.ajax({
                type: "PATCH",
                url: form.data('rota'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form.serialize(),
                dataType: "json",
                success: function(response) {
                    Swal.fire({
                        icon: response.tipo,
                        title: response.titulo,
                        text: response.mensagem,
                        timer: 3000
                    });
                    console.log(response);
                },
                error: function(reject) {
                    var responseJson = $.parseJSON(reject.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Atenção!",
                        text: responseJson.errors,
                        timer: 3000
                    });
                }
            });

        });
    </script>

</body>

</html>
