<?php
session_start();
ini_set('display_errors', 1);
require_once "./dependencias.php";
require_once "../classes/conexao.php";

if (isset($_SESSION['usuario'])) {


    $con = new Conexao();
    $conexao = $con->conectar();

    $sqlPesquisaDepartamentos = "SELECT idDepartamento, nomeDepartamento FROM departamentos";
    $resultPesquisaDepartamentos = mysqli_query($conexao, $sqlPesquisaDepartamentos);

    $sqlPesquisaFuncionarios = "SELECT f.idFuncionario, f.nomeFuncionario, d.nomeDepartamento FROM funcionarios as f inner join departamentos as d on f.idDepartamento = d.idDepartamento";
    $resultPesquisaFuncionarios = mysqli_query($conexao, $sqlPesquisaFuncionarios);
?>
    <!DOCTYPE html>
    <html lang="pt-PT">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Departamentos | SIGETES</title>
        <?php require_once "./top-side-bar-menu.php"; ?>

    </head>

    <body>

        <main class="container-fluid">
            <section>
                <h1>Registos de chefes de departamentos</h1>
                <?php 
                    echo ($_SESSION['idRoleUser']);
                ?>
                <div class="row">
                    <div class="group-labels text-right">
                        <a href="./departamentos.php"><span class="btn btn-link simple-label">Consultar/registar departamentos<spa data-bs-toggle="modal"></span></a>
                        <?php if (($_SESSION['idRoleUser'] == 1) || ($_SESSION['idRoleUser'] == 2)) { ?>
                            <span class="simple-label"><button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalRegistoChefeDepartamento">Associar novo chefe<i class="fas fa-plus-circle fa-fw fa-lg"></i></button></span>
                        <?php }; ?>
                    </div>

                    <form id="frmPesquisaFuncionario" class="frm-pesquisa">

                        <span>Pesquisa:</span>


                        <select id="itemsPesquisa" class="form-select">
                            <option>Escolha o campo</option>
                            <option value="codigoRegisto">Código de registo</option>
                            <option value="nomeDepartamento">Nome do departamento</option>
                            <option value="nomeChefe">Nome do chefe</option>
                            <option value="dataRegisto">Data de registo</option>
                        </select>



                        <input type="search" id="input-search" class="form-control" placeholder="Pesquise...">



                    </form>

                </div>


                <div class="row">




                    <div class="col-12">
                        <div id="tabelaChefesDepartamentosLoad"></div>
                    </div>
                </div>

            </section>


        </main>



        <!-- MODALS -->

        <!-- MODAL INSERCAO DEPARTAMENTO -->
        <div class="modal fade" id="modalRegistoChefeDepartamento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRegistoChefeDepartamento" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Registo de chefe de departamento</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" id="frmRegistoChefeDepartamento">
                            <div class="alert alert-danger alert-dismissible fade show error-fields-registo-departamento" role="alert"><i class="fas fa-exclamation-triangle"></i> Preencha os campos que são obrigatórios
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <div class="col-12">
                                <label for="txtNomeDepartamento" class="form-label">Nome do departamento</label>
                                <select name="txtNomeDepartamento" id="txtNomeDepartamento" class="form-control" onmousedown="document.querySelector('.item-not-to-select').remove()">
                                    <option selected disabled class="item-not-to-select">Selecione o departamento</option>
                                    <?php while ($dadosDepartamentos = mysqli_fetch_row($resultPesquisaDepartamentos)) : ?>
                                        <option value="<?php echo $dadosDepartamentos[0]; ?>"> <?php echo $dadosDepartamentos[1]; ?> </option>
                                    <?php endwhile; ?>
                                </select>

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>


                            <div class="col-12">
                                <label for="txtNomeChefe" class="form-label">Funcionário a nomear</label>
                                <select name="txtNomeChefe" id="txtNomeChefe" class="form-control">
                                    <option value="">Selecione o funcionário</option>
                                    <?php while ($dadosFuncionarios = mysqli_fetch_row($resultPesquisaFuncionarios)) : ?>
                                        <option value="<?php echo ($dadosFuncionarios[0]); ?>"> <?php echo ($dadosFuncionarios[1]); ?> -> Departamento: <?php echo ($dadosFuncionarios[2]); ?> </option>
                                    <?php endwhile; ?>
                                </select>

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" id="btnRegistarChefeDepartamento" class="form-control btn btn-success">Salvar departamento</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>


        <!-- MODAL EDICAO DEPARTAMENTO -->
        <div class="modal fade" id="modalEditarChefeDepartamento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarChefeDepartamento" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Edição de chefe de departamento</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
                        <p>Escolha o que pretende fazer:</p>
                        <h3><i class="fas fa-angle-right"></i> Tem a certeza que deseja desassociar o cargo de chefia ao funcionário actual? :</h3>

                        <div class="form-check">
                            <label for="yesToDesassociarChefeDepartamento" class="form-label">Sim <input type="radio" name="answerToDesassociarChefeDepartamento" id="yesToDesassociarChefeDepartamento"></label>|
                            <label for="noToDesassociarChefeDepartamento" class="form-label">Não <input type="radio" name="answerToDesassociarChefeDepartamento" id="noToDesassociarChefeDepartamento"></label>
                        </div>

                        <section id="area-edicao-chefe-departamento">
                            <form method="post" id="frmEdicaoChefeDepartamento">
                                <p><span class="label-details">Dados anteriores: </span></p>
                                <p><span class="label-details-items">Departamento em questão: </span><span id="departamentoActual"></span></p>
                                <p><span class="label-details-items">Funcionário como chefia: </span><span id="chefeActual"></span></p>
                                <p><span class="label-details-items">Tomada de posse em: </span><span id="dataTomadaPosse"></span></p>


                                <p><span class="label-details">Escolha o novo funcionário para associar ao cargo de chefia departamento em questão: </span></p>
                                <div class="col-8">
                                    <label for="txtFuncionarioChefia" class="form-label">Funcionário para chefia </label>
                                    <select name="txtFuncionarioChefia" id="txtFuncionarioChefia" class="form-control">
                                        <option value="">Selecione o novo funcionário</option>
                                        <?php
                                        $sqlPesquisaFuncionarios = "SELECT f.idFuncionario, f.nomeFuncionario, d.nomeDepartamento FROM funcionarios as f INNER JOIN departamentos as d on f.idDepartamento = d.idDepartamento";
                                        $resultPesquisaFuncionarios = mysqli_query($conexao, $sqlPesquisaFuncionarios);
                                        while ($dadosResultadoFuncionarios = mysqli_fetch_row($resultPesquisaFuncionarios)) : ?>
                                            <option value="<?php echo $dadosResultadoFuncionarios[0]; ?>"><?php echo $dadosResultadoFuncionarios[1] . " pertence a " . $dadosResultadoFuncionarios[2]; ?> </option>
                                        <?php endwhile; ?>
                                    </select>

                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>

                                    <input type="hidden" name="txtIdChefiaDepartamento" id="txtIdChefiaDepartamentos">
                                </div>

                                <div class="col-8">
                                    <button type="submit" class="form-control btn btn-success" id="btnEditarChefeDepartamento">
                                        Actualizar dados
                                    </button>
                                </div>
                            </form>
                        </section>
                    </div>

                </div>
            </div>

        </div>



        <!-- MODAL EXCLUSAO DEPARTAMENTO -->

        <div class="modal fade" id="modalConfirmacaoExclusaoChefiaDepartamento" tabindex="-1" aria-labelledby="Exclusao de chefe de  departamento" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Deseja excluir?</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem a certeza que deseja desassociar a chefia deste departamento ao funcionário?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnExcluirChefiaDepartamento"><i class="fas fa-trash"></i> Excluir</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL EDICAO DEPARTAMENTO -->


        <script>
            function excluirChefiaDepartamento(idChefiaDepartamento) {
                $('#btnExcluirChefiaDepartamento').on('click', function() {

                    $.ajax({
                        type: "POST",
                        data: "idChefiaDepartamento=" + idChefiaDepartamento,
                        url: "../procedimentos/departamentos/excluirChefeDepartamento.php",
                        success: function(r) {

                            if (r == 1) {
                                $("#btnExcluirChefiaDepartamento").prop('disabled', true);
                                alertify.notify('Departamento excluído com sucesso ', 'success', 2, function() {
                                    location.reload();
                                });
                            } else {
                                alertify.notify('Erro ao excluir', 'error', 2, function() {
                                    location.reload();
                                });
                            };
                        }
                    });
                });
            }

            function recuperarDadosEdicaoChefiaDepartamento(idChefiaDepartamento) {

                $.ajax({
                    type: "POST",
                    data: "idChefiaDepartamento=" + idChefiaDepartamento,
                    url: "../procedimentos/departamentos/recuperarDadosEdicaoChefiaDepartamento.php",
                    success: function(r) {
                        dados = jQuery.parseJSON(r);
                        $('#departamentoActual').text(dados['nomeDepartamento']);
                        $('#chefeActual').text(dados['nomeFuncionario']);
                        $('#dataTomadaPosse').text(dados['dataTomadaPosse']);
                        $('#txtIdChefiaDepartamentos').val(dados['idChefiaDepartamento']);
                    }
                });
            }


            $(document).ready(function() {
                $('#tabelaChefesDepartamentosLoad').load('./departamentos/tabelaChefiasDepartamento.php');

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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "nomeDepartamento") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "nomeChefe") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "dataRegisto") {
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
                    }
                });


                $('#yesToDesassociarChefeDepartamento').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-edicao-chefe-departamento').fadeIn('fast');
                        }, 150);
                    };
                });


                $('#noToDesassociarChefeDepartamento').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-edicao-chefe-departamento').fadeOut('fast');
                        }, 150)

                    };
                });

                function isNotEmpty(field) {
                    if (field.val() == "") {
                        $('.error-fields-registo-funcionario').fadeIn('fast');
                        field.css('border', 'solid 2px #dc3545');
                        $('#frmRegistoChefeDepartamento .campo-invalido-vazio').fadeIn('slow');
                        return false;
                    } else {
                        field.css('border', 'solid 2px #198754');
                        return true;
                    }
                };



                $('#btnRegistarChefeDepartamento').on('click', function() {
                    $('#frmRegistoChefeDepartamento').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    nomeDepartamento = $('#txtNomeDepartamento');
                    nomeFuncionarioChefe = $('#txtNomeChefe');

                    if (isNotEmpty(nomeDepartamento) && isNotEmpty(nomeFuncionarioChefe)) {
                        dados = $('#frmRegistoChefeDepartamento').serialize();
                        console.log(dados);
                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "../procedimentos/departamentos/adicionarChefeDepartamento.php",
                            success: function(r) {

                                if (r == 1) {
                                    $("#txtNomeDepartamento").prop('disabled', true);
                                    $("#txtNomeChefe").prop('disabled', true);
                                    $("#btnRegistarChefeDepartamento").prop('disabled', true);
                                    alertify.notify('Departamento registado com sucesso.', 'success', 2, function() {
                                        location.reload();
                                    });

                                } else {
                                    alertify.error('Erro ao registar.');
                                }

                            }
                        });
                    }

                });


                $('#btnEditarChefeDepartamento').on('click', function() {
                    $('#frmEdicaoChefeDepartamento').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    function isNotEmpty(field) {
                        if (field.val() == "") {
                            $('.error-fields-registo-funcionario').fadeIn('fast');
                            field.css('border', 'solid 2px #dc3545');
                            $('#frmEdicaoChefeDepartamento .campo-invalido-vazio').fadeIn('slow');
                            return false;
                        } else {
                            field.css('border', 'solid 2px #198754');
                            return true;
                        }
                    };

                    funcionarioChefia = $('#txtFuncionarioChefia');

                    dados = $('#frmEdicaoChefeDepartamento').serialize();



                    if (isNotEmpty(funcionarioChefia)) {
                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "../procedimentos/departamentos/editarChefiaDepartamento.php",
                            success: function(r) {
                                alert(r);
                                if (r == 1) {
                                    alert('successo');
                                } else {
                                    alert('Erro');
                                };
                            }
                        });
                    };


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