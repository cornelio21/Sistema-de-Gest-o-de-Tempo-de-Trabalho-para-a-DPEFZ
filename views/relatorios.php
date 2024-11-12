<?php
session_start();
ini_set('display_errors', 1);
require_once "./dependencias.php";
require_once "../classes/conexao.php";

if (isset($_SESSION['usuario'])) {

    $con = new Conexao();
    $conexao = $con->conectar();

    $sqlAnoProgressao = "SELECT DISTINCT YEAR(dataRegisto_progressao) from funcionarios_progressao_carreiras order by YEAR(dataRegisto_progressao) desc";
    $resultAnoProgressao = mysqli_query($conexao, $sqlAnoProgressao);

    $sqlAnoPromocao = "SELECT DISTINCT YEAR(dataRegisto_promocao) from funcionarios_promocao_carreiras order by YEAR(dataRegisto_promocao) desc";
    $resultAnoPromocao = mysqli_query($conexao, $sqlAnoProgressao);

    $sqlAnoAposentacao = "SELECT DISTINCT YEAR(dataAposentadoria) from funcionarios_aposentados order by YEAR(dataAposentadoria) desc";
    $resultAnoAposentacao = mysqli_query($conexao, $sqlAnoAposentacao);






?>
    <!DOCTYPE html>
    <html lang="pt-PT">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Área de funcionários | SIGETES</title>
        <?php require_once "./top-side-bar-menu.php"; ?>

    </head>

    <body>

        <main class="container-fluid">
            <section>
                <h1>Gestão de relatórios </h1>
                <div class="row">
                    <div class="col-12">
                        <p class="m-3 fw-bold">Por favor escolha que tipo de relatório deseja obter:</p>
                        <div class="accordion accordion-flush" id="accordion-area-relatorios">

                            <div class="accordion-item">
                                <button id="headingProgressao" type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#itemProgressao" aria-expanded="false" aria-controls="itemProgressao">

                                    <h2 class="accordion-header">
                                        <i class="fas fa-angle-right"></i> Obtenção de relatórios anuais associados às progressões na carreira dos funcionários
                                    </h2>
                                </button>

                                <div id="itemProgressao" class="accordion-collapse collapse" aria-labelledby="headingProgressao" data-bs-parent="#accordion-area-relatorios">
                                    <div class="accordion-body">
                                        <form action="../procedimentos/relatorios/obterRelatorioAnualProgressao.php" method="POST" id="frmObterRelatorioProgressao">
                                            <div class="col-4">
                                                <label for="optionYearProgressao" class="form-label">Escolha o ano a filtrar:</label>
                                                <select class="form-select" id="optionYearProgressao" name="optionYearProgressao">
                                                    <option value="" selected>Selecione o ano</option>
                                                    <?php

                                                    while ($dadosAnoProgressao = mysqli_fetch_row($resultAnoProgressao)) : ?>
                                                        <option value="<?php echo $dadosAnoProgressao[0]; ?>"><?php echo $dadosAnoProgressao[0]; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-success">Obter relatório</button>
                                            </div>



                                        </form>
                                    </div>
                                </div>

                            </div>


                            <div class="accordion-item">
                                <button id="headingPromocao" type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#itemPromocao" aria-expanded="false" aria-controls="itemProgressao">
                                    <h2 class="accordion-header">
                                        <i class="fas fa-angle-right"></i> Obtenção de relatórios anuais associados às promoções na carreira dos funcionários
                                    </h2>
                                </button>

                                <div id="itemPromocao" class="accordion-collapse collapse" aria-labelledby="headingPromocao" data-bs-parent="#accordion-area-relatorios">
                                    <div class="accordion-body">
                                        <form action="../procedimentos/relatorios/obterRelatorioAnualPromocao.php" method="POST" id="frmObterRelatorioPromocao">
                                            <div class="col-4">
                                                <label for="optionYearPromocao" class="form-label">Escolha o ano a filtrar:</label>
                                                <select class="form-select" id="optionYearPromocao" name="optionYearPromocao">
                                                    <option>Selecione o ano</option>
                                                    <?php

                                                    while ($dadosAnoPromocao = mysqli_fetch_row($resultAnoPromocao)) : ?>
                                                        <option value="<?php echo $dadosAnoPromocao[0]; ?>"> <?php echo $dadosAnoPromocao[0]; ?> </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-success">Obter relatório</button>
                                            </div>



                                        </form>
                                    </div>
                                </div>

                            </div>


                            <div class="accordion-item">
                                <button id="headingAposentadoria" type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#itemAposentadoria" aria-expanded="false" aria-controls="itemAposentadoria">
                                    <h2 class="accordion-header">
                                        <i class="fas fa-angle-right"></i> Obtenção de relatórios associados às aposentação dos funcionários
                                    </h2>
                                </button>

                                <div id="itemAposentadoria" class="accordion-collapse collapse" aria-labelledby="headingAposentadoria" data-bs-parent="#accordion-area-relatorios">
                                    <div class="accordion-body">
                                        <p>Por escolha uma das opções</p>
                                        <h3><i class="fas fa-angle-right"></i> Obter relatorios de aposentações de determinado ano</h3>
                                        <label for="yesAnswerToAposentacaoYear" class="form-label">Sim<input type="radio" name="answerToAposentacaoYear" id="yesAnswerToAposentacaoYear"></label>
                                        <label for="noAnswerToAposentacaoYear" class="form-label">Não<input type="radio" name="answerToAposentacaoYear" id="noAnswerToAposentacaoYear"></label>
                                        <section id="area-relatorio-aposentacao-anual">
                                            <form method="POST" action="../procedimentos/relatorios/obterRelatorioAnualAposentacao.php" id="frmRelatorioAposentacaoAnual">
                                                <div class="col-4">
                                                    <label for="optionYearAposentacao" class="form-label">Escolha o ano a filtrar:</label>
                                                    <select class="form-select" id="optionYearAposentacao" name="optionYearAposentacao">
                                                        <option selected>Selecione o ano</option>
                                                        <?php

                                                        while ($dadosAnoAposentacao = mysqli_fetch_row($resultAnoAposentacao)) : ?>
                                                            <option value="<?php echo $dadosAnoAposentacao[0]; ?>"><?php echo $dadosAnoAposentacao[0]; ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-success">Obter relatório</button>
                                                </div>
                                            </form>

                                        </section>
                                        <h3><i class="fas fa-angle-right"></i> Obter relatorios de funcionarios que estão aptos para a aposentação</h3>
                                        <label for="yesAnswerToAposentacao" class="form-label">Sim<input type="radio" name="answerToAposentacao" id="yesAnswerToAposentacao"></label>
                                        <label for="noAnswerToAposentacao" class="form-label">Não<input type="radio" name="answerToAposentacao" id="noAnswerToAposentacao"></label>
                                        <section id="area-relatorio-para-aposentacao">
                                            <form id="frmRelatorioParaAposentacao" method="POST" action="../procedimentos/relatorios/obterRelatorioGeneroAposentacao.php">
                                                <div class="col-4">
                                                    <label for="optionGenderAposentacao" class="form-label">Escolha o genero a filtrar:</label>
                                                    <select class="form-select" id="optionGenderAposentacao" name="optionGenderAposentacao">
                                                        <option selected>Selecione o genero</option>
                                                        <option value="M">Masculino</option>
                                                        <option value="F">Femenino</option>
                              

                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-success">Obter relatório</button>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>

                            </div>

                        </div>






                    </div>



            </section>


        </main>






        <script>

        </script>
        <script>
            $(document).ready(function() {

                $('#yesAnswerToAposentacaoYear').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-relatorio-aposentacao-anual').fadeIn('fast');
                            $('#area-relatorio-para-aposentacao').fadeOut('fast');
                        }, 150);
                    }
                });


                $('#noAnswerToAposentacaoYear').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-relatorio-aposentacao-anual').fadeOut('fast');
                        }, 150);
                    }
                });

                $('#yesAnswerToAposentacao').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-relatorio-para-aposentacao').fadeIn('fast');
                            $('#area-relatorio-aposentacao-anual').fadeOut('fast');
                        }, 150);
                    }
                });


                $('#noAnswerToAposentacao').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-relatorio-para-aposentacao').fadeOut('fast');
                        }, 150);
                    }
                });

          

                });

           
        </script>
    </body>

    </html>

<?php 
} else {
    header("location:../index.php");
};

?>