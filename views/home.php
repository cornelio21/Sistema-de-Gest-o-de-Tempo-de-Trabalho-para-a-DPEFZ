<?php
session_start();
ini_set('display_errors', 1);
require_once "./dependencias.php";
require_once "../classes/conexao.php";

if (isset($_SESSION['usuario'])) {

    $con = new Conexao();
    $conexao = $con->conectar();

    $sqlNumeroTotalFuncionarios = "SELECT idFuncionario from funcionarios";
    $resultadoNumeroTotalFuncionarios = mysqli_query($conexao, $sqlNumeroTotalFuncionarios);
    $numeroTotalFuncionarios = mysqli_num_rows($resultadoNumeroTotalFuncionarios);


    $sqlNumeroTotalFuncionariosAposentados = "SELECT idfuncionario_aposentado from funcionarios_aposentados";
    $resultadoNumeroTotalFuncionariosAposentados = mysqli_query($conexao, $sqlNumeroTotalFuncionariosAposentados);
    $numeroTotalFuncionariosAposentados = mysqli_num_rows($resultadoNumeroTotalFuncionariosAposentados);

    $sqlNumeroTotalFuncionariosProgressao = "SELECT idFuncionario_progressao from funcionarios_progressao_carreiras";
    $resultadoNumeroTotalFuncionariosProgressao = mysqli_query($conexao, $sqlNumeroTotalFuncionariosProgressao);
    $numeroTotalFuncionariosProgressao = mysqli_num_rows($resultadoNumeroTotalFuncionariosProgressao);

    $sqlNumeroTotalFuncionariosPromocao = "SELECT idFuncionario_promovido from funcionarios_promocao_carreiras";
    $resultadoNumeroTotalFuncionariosPromocao = mysqli_query($conexao, $sqlNumeroTotalFuncionariosPromocao);
    $numeroTotalFuncionariosPromocao = mysqli_num_rows($resultadoNumeroTotalFuncionariosPromocao);


?>
    <!DOCTYPE html>
    <html lang="pt-PT">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Área Inicial - SIGETES</title>
        <?php require_once "./top-side-bar-menu.php"; ?>

    </head>

    <body>

        <main class="container-fluid">
    <h1><?php ?></h1>
            <div class="row text-center card-container">

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Total de funcionários registados</h2>
                            <span class="card-text card-number">
                                <?php echo $numeroTotalFuncionarios; ?>
                            </span>
                            <span class="card-text">Funcionários</span><br>
                            <a class="card-link" href="./funcionarios.php">Visualizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Total de aposentadorias</h2>
                            <span class="card-text card-number">
                                <?php echo $numeroTotalFuncionariosAposentados; ?>
                            </span>
                            <span class="card-text">Aposentados</span><br>
                            <a class="card-link" href="./funcionariosAposentados.php">Visualizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Total de progressões</h2>
                            <span class="card-text card-number"> <?php echo $numeroTotalFuncionariosProgressao; ?></span>
                            <span class="card-text">Funcionários</span><br>
                            <a class="card-link" href="./progressaoFuncionarios.php">Visualizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Total de promoções</h2>
                            <span class="card-text card-number"><?php echo $numeroTotalFuncionariosPromocao; ?></span>
                            <span class="card-text">Funcionários</span><br>
                            <a class="card-link" href="./promocaoFuncionarios.php">Visualizar</a>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </body>

    <script>
        window.onload = function() {

            alertify.set('notifier', 'position', 'top-center');
            var notification = alertify.notify('Bem-vindo', 'custom', 1.5);

        }
    </script>

    </html>

<?php
} else {
    header("location:../index.php");
}

?>