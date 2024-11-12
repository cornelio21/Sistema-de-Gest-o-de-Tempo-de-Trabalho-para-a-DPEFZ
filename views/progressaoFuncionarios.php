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
        <title>Área progressão dos funcionários | SIGETES</title>
        <?php require_once "./top-side-bar-menu.php"; ?>

    </head>

    <body>

        <main class="container-fluid">
            <section>
                <h1>Registos das progressões dos funcionários</h1>

                <div class="row">
                    <form id="frmPesquisaFuncionario" class="frm-pesquisa">


                        <span>Pesquisa:</span>


                        <select id="itemsPesquisa" class="form-select ">
                            <option>Escolha o campo</option>
                            <option value="codigoRegisto">Código de registo</option>
                            <option value="nomeFuncionario">Nome do funcionário</option>
                            <option value="cargo">Cargo que assume</option>
                            <option value="escalaoAntigo">Escalão antigo</option>
                            <option value="escalaoActual">Escalão actual</option>
                            <option value="dataProgressao">Data progressão</option>
                        </select>



                        <input type="search" id="input-search" class="form-control" placeholder="Pesquise...">



                    </form>

                </div>



                <div class="row">
                    <div class="col-12">
                        <div id="tabelaProgressaoFuncionariosLoad"></div>
                    </div>
                </div>

            </section>


        </main>



        <script>
            $(document).ready(function() {
                $('#tabelaProgressaoFuncionariosLoad').load('./funcionarios/tabelaProgressaoFuncionarios.php');

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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "cargo") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "escalaoAntigo") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "escalaoActual") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "dataProgressao") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(5).text();
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