<?php
session_start();
ini_set('display_errors', 1);
require_once "./dependencias.php";
require_once "../classes/conexao.php";

if (isset($_SESSION['usuario'])) {



?>
    <!DOCTYPE html>
    <html lang="pt-PT">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Área funcionários aposentados | SIGETES</title>
        <?php require_once "./top-side-bar-menu.php"; ?>

    </head>

    <body>

        <main class="container-fluid">
            <section>
                <h1>Registos de funcionários aposentados</h1>

                <div class="row">


                    <form id="frmPesquisaFuncionario" class="frm-pesquisa">


                        <span>Pesquisa:</span>


                        <select id="itemsPesquisa" class="form-select ">
                            <option>Escolha o campo</option>
                            <option value="codigoRegisto">Código de registo</option>
                            <option value="nomeFuncionario">Nome do funcionário</option>
                            <option value="anosCarreira">Anos de carreira</option>
                            <option value="dataInicioCarreira">Data inicio de carreira</option>
                            <option value="dataAposentacao">Data de aposentação</option>
                        </select>



                        <input type="search" id="input-search" class="form-control" placeholder="Pesquise...">


                    </form>

                </div>



                <div class="row">
                    <div class="col-12">
                        <div id="tabelaFuncionariosAposentadosLoad"></div>
                    </div>
                </div>

            </section>


        </main>



        <script>
            $(document).ready(function() {
                $('#tabelaFuncionariosAposentadosLoad').load('./funcionarios/tabelaFuncionariosAposentados.php');

                $('#itemsPesquisa').on('change', function() {
                    if ($('#itemsPesquisa option').filter(':selected').val() == "codigoRegisto") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(0).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "nomeFuncionario") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(1).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "anosCarreira") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(2).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "dataInicioCarreira") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(3).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "dataAposentacao") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(4).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    }

                });

            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location:../index.php");
}

?>