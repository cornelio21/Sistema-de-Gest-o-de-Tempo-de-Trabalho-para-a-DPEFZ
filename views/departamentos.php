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
        <title>Departamentos | SIGETES</title>
        <?php require_once "./top-side-bar-menu.php"; ?>

    </head>

    <body>

        <main class="container-fluid">
            <section>
                <h1>Registos de departamentos</h1>

                <div class="row">
                    <div class="group-labels text-right">
                        <a href="./chefiasDepartamentos.php"><span class="btn btn-link simple-label">Consultar/registar chefes dos departamentos</span></a>
                        <?php if (($_SESSION['idRoleUser'] == 1) || ($_SESSION['idRoleUser'] == 2)) { ?>
                            <span class="simple-label"><button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalRegistoDepartamento">Registar novo departamento<i class="fas fa-plus-circle fa-fw fa-lg"></i></button></span>
                        <?php }; ?>
                    </div>


                    <form id="frmPesquisaFuncionario" class="frm-pesquisa">


                        <span>Pesquisa:</span>


                        <select name="" id="itemsPesquisa" class="form-select ">
                            <option>Escolha o campo</option>
                            <option value="codigoRegisto">Código de registo</option>
                            <option value="nomeDepartamento">Nome do departamento</option>
                            <option value="totalFuncionarios">Total de funcionários</option>
                            <option value="dataRegisto">Data de registo</option>
                        </select>



                        <input type="search" id="input-search" class="form-control" placeholder="Pesquise...">



                    </form>

                </div>



                <div class="row">
                    <div class="col-12">
                        <div id="tabelaDepartamentosLoad"></div>
                    </div>
                </div>

            </section>


        </main>



        <!-- MODALS -->

        <!-- MODAL INSERCAO DEPARTAMENTO -->
        <div class="modal fade" id="modalRegistoDepartamento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRegistoDepartamento" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Registo de departamento</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" id="frmRegistoDepartamento">
                            <div class="alert alert-danger alert-dismissible fade show error-fields-registo-departamento" role="alert"><i class="fas fa-exclamation-triangle"></i> Preencha os campos que são obrigatórios
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <div class="col-12">
                                <label for="txtNomeDepartamento" class="form-label">Nome do departamento</label>
                                <input type="text" id="txtNomeDepartamento" name="txtDepartamento" class="form-control" placeholder="Nome do departamento">

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" id="btnRegistarDepartamento" class="form-control btn btn-success">Salvar departamento</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>


        <!-- MODAL EXCLUSAO DEPARTAMENTO -->

        <div class="modal fade" id="modalConfirmacaoExclusaoDepartamento" tabindex="-1" aria-labelledby="Exclusao de departamento" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Deseja excluir?</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem a certeza que deseja mesmo excluir o departamento?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnExcluir"><i class="fas fa-trash"></i> Excluir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDICAO DEPARTAMENTO -->
        <div class="modal fade" id="modalEdicaoDepartamento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdicaoUsuario" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Edição de departamento</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" id="frmEdicaoDepartamento">
                            <div class="alert alert-danger alert-dismissible fade show error-fields-registo-departamento" role="alert"><i class="fas fa-exclamation-triangle"></i> Preencha os campos que são obrigatórios
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <div class="col-12">
                                <label for="txtIdDepartamentoEdicao" class="form-label">Código do departamento</label>
                                <input type="text" id="txtIdDepartamentoEdicao" name="txtIdDepartamentoEdicao" class="form-control" placeholder="Código do departamento" readonly>

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="txtNomeDepartamentoEdicao" class="form-label">Nome do departamento</label>
                                <input type="text" id="txtNomeDepartamentoEdicao" name="txtNomeDepartamentoEdicao" class="form-control" placeholder="Nome do departamento">

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" id="btnEdicaoDepartamento" class="form-control btn btn-success">Editar dados</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

        <!-- MODAL DADOS DETALHADOS -->
        <div class="modal fade" id="modalMostrarDetalhesDepartamento">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Dados detalhados de funcionário</h2>
                    </div>

                    <div class="modal-body">
                        <p><span class="label-details">Código de registo: </span> <span id="codigoRegistoDepartamento"></span></p>
                        <p> <span class="label-details">Nome do departamento: </span> <span id="nomeDepartamento"></span></p>
                        <p><span class="label-details">Chefe do departamento: </span> <span id="ChefeDepartamento"></span> </p>
                        <p><span class="label-details">Número total de funcionários registados: </span> <span id="numeroTotalfuncionarios"></span></p>
                        <p><span class="label-details">Data de registo:</span> <span id="dataRegisto"></span></p>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function excluirDepartamento(idDepartemento) {
                $('#btnExcluir').on('click', function() {
                    $.ajax({
                        type: "POST",
                        data: "idDepartamento=" + idDepartemento,
                        url: "../procedimentos/departamentos/excluirDepartamento.php",
                        success: function(r) {
                            if (r == 1) {
                                $("#btnExcluir").prop('disabled', true);
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
            };

            function recuperarDadosEdicaoDepartamento(idDepartamento) {
                $.ajax({
                    type: "POST",
                    data: "idDepartamento=" + idDepartamento,
                    url: "../procedimentos/departamentos/recuperarDadosEdicaoDepartamento.php",
                    success: function(r) {
                        dados = jQuery.parseJSON(r);

                        $('#txtIdDepartamentoEdicao').val(dados['idDepartamento']);
                        $('#txtNomeDepartamentoEdicao').val(dados['nomeDepartamento']);


                    }
                });
            };

            function recuperarDadosDepartamentoDetalhados(idDepartamento) {
                $.ajax({
                    type: "POST",
                    data: "idDepartamento=" + idDepartamento,
                    url: "../procedimentos/departamentos/recuperarDadosDepartamentoDetalhados.php",
                    success: function(r) {
                        dados = jQuery.parseJSON(r);

                        $('#codigoRegistoDepartamento').text(dados['idDepartamento']);
                        $('#nomeDepartamento').text(dados['nomeDepartamento']);
                        $('#ChefeDepartamento').text(dados['nomeChefiaDepartamento']);
                        $('#numeroTotalfuncionarios').text(dados['numeroTotalFuncionarios']);
                        $('#dataRegisto').text(dados['dataRegistoDepartamento']);
                    }
                })
            }

            $(document).ready(function() {
                $('#tabelaDepartamentosLoad').load('./departamentos/tabelaDepartamentos.php');

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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "totalFuncionarios") {
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

                $('#btnRegistarDepartamento').on('click', function() {
                    $('#frmRegistoDepartamento').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    nomeDepartamento = $('#txtNomeDepartamento');


                    function isNotEmpty(field) {
                        if (field.val() == "") {
                            $('.error-fields-registo-funcionario').fadeIn('fast');
                            field.css('border', 'solid 2px #dc3545');
                            $('#frmRegistoDepartamento .campo-invalido-vazio').fadeIn('slow');
                            return false;
                        } else {
                            field.css('border', 'solid 2px #198754');
                            return true;
                        }
                    };

                    if (isNotEmpty(nomeDepartamento)) {
                        dados = $('#frmRegistoDepartamento').serialize();

                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "../procedimentos/departamentos/adicionarDepartamento.php",
                            success: function(r) {

                                if (r == 1) {
                                    $("#txtNomeDepartamento").prop('disabled', true);
                                    $("#btnRegistarDepartamento").prop('disabled', true);
                                    alertify.notify('Departamento registado com sucesso', 'success', 2, function() {
                                        location.reload();
                                    });


                                } else {
                                    alert("Erro ao editar");
                                };
                            }
                        });

                    };
                });

                $('#btnEdicaoDepartamento').on('click', function() {
                    $('#frmEdicaoDepartamento').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    nomeDepartamento = $('#txtNomeDepartamentoEdicao');


                    function isNotEmpty(field) {
                        if (field.val() == "") {
                            $('.error-fields-registo-funcionario').fadeIn('fast');
                            field.css('border', 'solid 2px #dc3545');
                            $('#frmEdicaoDepartamento .campo-invalido-vazio').fadeIn('slow');
                            return false;
                        } else {
                            field.css('border', 'solid 2px #198754');
                            return true;
                        }
                    };

                    if (isNotEmpty(nomeDepartamento)) {
                        dados = $('#frmEdicaoDepartamento').serialize();

                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "../procedimentos/departamentos/edicaoDepartamento.php",
                            success: function(r) {

                                if (r == 1) {
                                    $("#txtIdDepartamentoEdicao").prop('disabled', true);
                                    $("#btnEdicaoDepartamento").prop('disabled', true);
                                    alertify.notify('Departamento editado com sucesso', 'success', 2, function() {
                                        location.reload();
                                    });


                                } else {
                                    alert("Erro ao salvar");
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