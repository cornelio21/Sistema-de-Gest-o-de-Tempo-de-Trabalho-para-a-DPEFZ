<?php
require_once "./classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sql = "SELECT * FROM usuarios where idRole_Users = 1";

$result = mysqli_query($conexao, $sql);

$hasSuperAdmin = false;

if (mysqli_fetch_row($result) > 0) {
    $hasSuperAdmin = true;
}

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./libs/bootstrap-5.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login | SIGETES</title>
</head>

<body>
    <main>
        <section id="login-area" class="text-center">

            <div id="img-login-area">
                <img src="imgs/logo.png" alt="">
            </div>
            <h1>SPEFZ - SIGETES</h1>
            <div class="alert alert-danger fade show alert-login alert-login-invalid" role="alert"><i class="far fa-times-circle fa-lg"></i>Não deixe os campos em branco, preencha com o email e senha de usuário do sistema.</div>


            <form id="login-form" class="mt-4" method="POST">
                <h2>Autenticação</h2>
                <div class="input-group mt-4 mb-4">
                    <span class="input-group-text"><i class="fas fa-user .errors-fields"></i></span>
                    <input autofocus type="email" name="username" id="txtUsername" class="form-control" aria-describedby="txtUsername" placeholder="E-mail do usuário">

                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" name="password" id="txtPassword" class="form-control" placeholder="Senha do usuário">

                </div>

                <div class="input-group my-4">
                    <p>
                        <button type="submit" class="btn btn-primary shadow-sm" id="btnEfectuarLogin">
                            Entrar
                        </button>


                        <?php if (!$hasSuperAdmin) : ?>
                            <a class="btn-link" href="./views/registar.php">
                                ou, Registar (Super admin)
                            </a>

                        <?php endif; ?>
                    </p>
                </div>

            </form>


        </section>

    </main>


    <script src="./libs/jquery/jquery-3.5.1.min.js"></script>
    <script src="libs/bootstrap-5.0.0/js/bootstrap.min.js"></script>
    <script defer src="libs/fontawesome-5.15.2/js/all.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        $('#btnEfectuarLogin').on('click', function() {

            $('#login-form').on("submit", function(evento) {
                evento.preventDefault();
            })

            username = $('#txtUsername');
            senha = $('#txtPassword');

            function isNotEmptyLoginFields(field) {
                if (field.val() == "") {
                    $('.alert-login-invalid').fadeIn('fast');
                    $('.alert-login-valid').fadeOut('fast');
                    field.toggleClass('errors-fields');
                    return false;
                } else {
                    field.removeClass('errors-fields');
                    $('.alert-login-valid').fadeIn('fast');
                    $('.alert-login-invalid').fadeOut('fast');
                    return true;
                };
            };

            if (isNotEmptyLoginFields(username) && isNotEmptyLoginFields(senha)) {
                dados = $('#login-form').serialize();
                
                $.ajax({
                    type: "POST",
                    data: dados,
                    url: "./procedimentos/login/efectuarLogin.php",
                    success: function(r) {
                        
                        if (r == 1) {
                            window.location = "./views/home.php";
                            
                        } else {
                            alert("Deu erro");
                        };
                    }
                });

            };

        });
    </script>
</body>

</html>