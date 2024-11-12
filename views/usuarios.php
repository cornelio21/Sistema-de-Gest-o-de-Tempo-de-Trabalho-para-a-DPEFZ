<?php
session_start();
ini_set('display_errors', 1);
require_once "./dependencias.php";
require_once "../classes/conexao.php";

if (isset($_SESSION['usuario'])) {

    $con = new Conexao();
    $conexao = $con->conectar();

    $sqlPesquisarFuncionarios = "SELECT f.idFuncionario, f.nomeFuncionario, d.nomeDepartamento from funcionarios as f join departamentos as d on f.idDepartamento = d.idDepartamento";
    $resultPesquisarFuncionarios = mysqli_query($conexao, $sqlPesquisarFuncionarios);

    $sqlPesquisarROLE_USERS = "SELECT idROLE_USER, tipoROLE_USER from ROLE_USERS";
    $resultPesquisarROLE_USERS = mysqli_query($conexao, $sqlPesquisarROLE_USERS);

    $sqlPesquisarROLE_USERSEdicao = "SELECT idROLE_USER, tipoROLE_USER from ROLE_USERS";
    $resultPesquisarROLE_USERSEdicao = mysqli_query($conexao, $sqlPesquisarROLE_USERS);


?>
    <!DOCTYPE html>
    <html lang="pt-PT">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuários | SIGETES</title>
        <?php require_once "./top-side-bar-menu.php"; ?>

    </head>

    <body>

        <main class="container-fluid">
            <section>
                <h1>Gestão de usuários</h1>


                <div class="row">
                    <span class="simple-label"><button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalRegistoUsuario">Registar novo usuário <i class="fas fa-plus-circle fa-fw fa-lg text-success"></i></button></span>

                    <form id="frmPesquisaFuncionario" class="frm-pesquisa">


                        <span>Pesquisa:</span>
                        <select id="itemsPesquisa" class="form-select ">
                            <option>Escolha o campo</option>
                            <option value="codigoRegisto">Código de registo</option>
                            <option value="nomeFuncionario">Nome do funcionário</option>
                            <option value="email">E-mail/Correio electrónico</option>
                            <option value="tipoUsuario">Tipo de usuário</option>
                            <option value="dataRegisto">Data de registo (ano-mês-dia)</option>
                        </select>



                        <input type="search" id="input-search" class="form-control" placeholder="Pesquise...">



                    </form>

                </div>


                <div class="row">

                    <div class="col-12">
                        <div id="tabelaUsuariosLoad"></div>
                    </div>

                </div>

            </section>


        </main>

        <!-- MODALS -->

        <div class="modal fade" id="modalRegistoUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRegistoUsuario" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Registo de usuário de sistema</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
                        <form id="frmRegistoUsuario" class="row" method="POST">

                            <div class="alert alert-danger alert-dismissible fade show error-fields-registo-usuario" role="alert"><i class="fas fa-exclamation-triangle"></i> Preencha os campos que são obrigatórios
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <div class="alert alert-danger alert-wrong-password" role="alert">
                                A senhas não coicidem. Volte a introduzir as senhas de acesso do usuário.
                            </div>

                            <div class="col-12">
                                <label for="txtFuncionarioUsuario" class="form-label">Escolha o funcionario</label>
                                <select class="form-control" name="txtFuncionarioUsuario" id="txtFuncionarioUsuario" id="lista-funcionarios">
                                    <option selected>Escolha um funcionário</option>
                                    <?php


                                    while ($dados = mysqli_fetch_row($resultPesquisarFuncionarios)) : ?>

                                        <option value="<?php echo ($dados[0]); ?>"><?php echo ($dados[1]); ?> -> Departamento:<?php echo ($dados[2]); ?> </option>
                                    <?php endwhile; ?>
                                </select>

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>


                            <div class="col-12">
                                <label for="txtEmail" class="form-label">Correio electrónico/E-mail</label>
                                <input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="E-mail">


                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="txtUserRole" class="form-label">Tipo de usuário</label>
                                <select class="form-control" id="txtUserRole" name="txtUserRole">
                                    <option value="" selected>Escolha o tipo de usuário em relação ao previlégios</option>
                                    <?php

                                    while ($dados = mysqli_fetch_row($resultPesquisarROLE_USERS)) : ?>

                                        <option value="<?php echo $dados[0]; ?>"><?php echo $dados[1]; ?></option>

                                    <?php endwhile; ?>
                                </select>


                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-8">
                                <label for="txtSenha" class="form-label">Digite a senha do usuário</label>
                                <input type="password" name="txtSenha" id="txtSenha" class="form-control" placeholder="Digite uma senha">

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-8">
                                <label for="txtSenhaConfirmacao" class="form-label">Volte a digitar a senha</label>
                                <input type="password" id="txtSenhaConfirmacao" class="form-control" placeholder="Volte a digitar uma senha">

                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>


                            <div class="col-4">
                                <button type="submit" class="btn btn-success" id="btnRegistarUsuario">Salvar usuário</button>
                            </div>


                        </form>
                    </div>



                </div>
            </div>

        </div>

        <!-- MODAL EXCLUSAO -->

        <div class="modal fade" id="modalConfirmacaoExclusaoUsuario" tabindex="-1" aria-labelledby="Exclusao de usuário" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Deseja excluir?</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem a certeza que deseja excluir este usuário de sistema?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnExcluirUsuario"><i class="fas fa-trash"></i> Excluir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDICAO USUARIO -->

        <div class="modal fade" id="modalEdicaoUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdicaoUsuario" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Edição de usuário de sistema</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
                        <p>Escolha o que pretende fazer</p>
                        <h3><i class="fas fa-angle-right"></i> Deseja alterar o tipo de usuário de sistema? :</h3>
                        <label for="yesToEditUserRole" class="form-label">Sim</label> <input type="radio" name="answerToEditUserRole" id="yesToEditUserRole">|
                        <label for="noToEditUserRole" class="form-label">Não</label> <input type="radio" name="answerToEditUserRole" id="noToEditUserRole">
                        <section id="area-edicao-user-role">
                            <form id="frmEdicaoUsuario" class="row" method="POST">

                                <div class="col-4">
                                    <input id="txtIdUsuario" name="txtIdUsuario" class="form-control" hidden></input>
                                    <p><span class="label-details">Nome completo: </span> <span id="userName"></span></p>
                                    <p><span class="label-details">E-mail de acesso: </span> <span id="userEmailToLogin"></span></p>
                                    <p><span class="label-details">Tipo usuário actual: </span> <span id="userRoleActual"></span></p>
                                    <label for="txtUserRoleEdicao" class="form-label">Alterar o tipo de usuário para: </label>
                                    <select class="form-control" id="txtTipoUsuario" name="txtTipoUsuario">
                                        <option value="">Escolha o tipo de usuário</option>
                                        <?php while ($dadosPesquisarROLE_USERSEdicao = mysqli_fetch_row($resultPesquisarROLE_USERSEdicao)) : ?>
                                            <option value="<?php echo $dadosPesquisarROLE_USERSEdicao[0]; ?>"><?php echo $dadosPesquisarROLE_USERSEdicao[1]; ?></option>

                                        <?php endwhile; ?>

                                    </select>


                                    <div class="col-8">
                                        <button type="submit" class="btn btn-success" id="btnEditarUsuario">Salvar usuário</button>
                                    </div>
                                </div>

                            </form>
                        </section>

                    </div>



                </div>
            </div>

        </div>

        <!-- MODAL DADOS DETALHADOS -->
        <div class="modal fade" id="modalMostrarDetalhesUsuario">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Dados detalhados do usuário</h2>
                    </div>

                    <div class="modal-body">
                        <p><span class="label-details">Código de registo: </span> <span id="codigoRegistoUsuario"></span></p>
                        <p><span class="label-details">Nome completo: </span> <span id="nomeUsuario"></span></p>
                        <p><span class="label-details">Cargo: </span> <span id="cargoUsuario"></span></p>
                        <p><span class="label-details">Departamento a que pertence:</span> <span id="departamentoUsuario"></span></p>
                        <p><span class="label-details">E-mail/correio electrónico(para aceder ao sistema):</span> <span id="emailUsuario"></span></p>
                        <p><span class="label-details">Tipo de usuário: </span><span id="tipoUsuario"></span></p>
                        <p><span class="label-details">Data de registo do usuário: </span><span id="dataRegistoUsuario"></span></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function excluirUsuario(idUsuario) {
                $('#btnExcluirUsuario').on('click', function() {
                    $.ajax({
                        type: "POST",
                        data: "idUsuario=" + idUsuario,
                        url: "../procedimentos/usuarios/excluirUsuario.php",
                        success: function(r) {
                            if (r == 1) {
                                $("#btnExcluirUsuario").prop('disabled', true);
                                alertify.notify('Usuário excluído com sucesso ', 'success', 2, function() {
                                    location.reload();
                                });
                            } else {
                                alertify.notify('Erro ao excluir', 'error', 2, function() {
                                    location.reload();
                                });
                            }
                        },
                    });

                });

            }

            function recuperarDadosUsuario(idUsuario) {

                $.ajax({
                    type: "POST",
                    data: "idUsuario=" + idUsuario,
                    url: "../procedimentos/usuarios/recuperarDadosEdicaoUsuario.php",
                    success: function(r) {


                        dados = jQuery.parseJSON(r);
                        console.log("idUsuario = " + dados['idUsuario']);

                        $('#userRoleActual').text(dados['tipoRole']);
                        $('#userName').text(dados['nomeFuncionario']);
                        $('#userEmailToLogin').text(dados['emailUsuario']);
                        $('#txtIdUsuario').val(dados['idUsuario']);



                    }

                });

            }

            function recuperarDadosDetalhadosUsuario(idUsuario) {
                $.ajax({
                    type: "POST",
                    data: "idUsuario=" + idUsuario,
                    url: "../procedimentos/usuarios/recuperarDadosDetalhadosUsuario.php",
                    success: function(r) {
                        dados = jQuery.parseJSON(r);
                        console.log(dados['idUsuario']);
                        $('span#codigoRegistoUsuario').text(dados['idUsuario']);
                        $('#nomeUsuario').text(dados['nomeUsuario']);
                        $('#cargoUsuario').text(dados['cargoUsuario']);
                        $('#departamentoUsuario').text(dados['nomeDepartamento']);
                        $('#emailUsuario').text(dados['emailUsuario']);
                        $('#tipoUsuario').text(dados['tipoUsuario']);
                        $('#dataRegistoUsuario').text(dados['dataRegistoUsuario']);
                    }
                });
            }

            $(document).ready(function() {
                $('#tabelaUsuariosLoad').load('./usuarios/tabelaUsuarios.php');


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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "email") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "tipoUsuario") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "dataRegisto") {
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
                })
            });

            $('#yesToEditUserRole').on('change', function() {
                if ($(this).prop('checked') == true) {
                    setTimeout(function() {
                        $('#area-edicao-user-role').fadeIn('fast');
                    }, 150);
                }
            });


            $('#noToEditUserRole').on('change', function() {
                if ($(this).prop('checked') == true) {
                    setTimeout(function() {
                        $('#area-edicao-user-role').fadeOut('fast');
                    }, 150);
                }
            });

            $('#btnRegistarUsuario').on('click', function() {
                $('#frmRegistoUsuario').on('submit', function(evento) {
                    evento.preventDefault();
                });

                idFuncionario = $('#txtFuncionarioUsuario');
                emailFuncionario = $('#txtEmail');
                roleUser = $('#txtUserRole');
                senha = $('#txtSenha');
                confirmacaoSenha = $('#txtSenhaConfirmacao');
                textValue = $('#txtFuncionarioUsuario').val();
                idValueFuncionario = $('#lista-funcionarios [value ="' + textValue + '"]').data('value');

                function isNotEmptyUsuario(field) {
                    if (field.val() == "") {
                        $('.error-fields-registo-usuario').fadeIn('fast');
                        field.css('border', 'solid 2px #dc3545');
                        return false;
                    } else {
                        if (isNotDifferentPassword(senha, confirmacaoSenha)) {
                            field.css('border', 'solid 2px #198754');
                        } else {
                            senha.css('border', 'solid 2px #dc3545');
                            confirmacaoSenha.css('border', 'solid 2px #dc3545');
                        }
                        return true;
                    };
                };

                function isNotDifferentPassword(password, passwordConfirm) {
                    if (password.val() == passwordConfirm.val()) {
                        $('.alert-wrong-password').fadeOut('fast');

                        return true;
                    } else {
                        $('.alert-wrong-password').fadeIn('fast');
                        return false;
                    }
                };

                if (isNotEmptyUsuario(idFuncionario) && isNotEmptyUsuario(emailFuncionario) && isNotEmptyUsuario(roleUser) && isNotEmptyUsuario(senha) && isNotEmptyUsuario(confirmacaoSenha)) {
                    if (isNotDifferentPassword(senha, confirmacaoSenha)) {
                        dados = $('#frmRegistoUsuario').serialize();

                        $.ajax({
                            url: "../procedimentos/login/adicionarUsuario.php",
                            method: 'POST',
                            data: dados,
                            success: function(r) {
                                if (r == 1) {
                                    $('#tabelaUsuariosLoad').load('./usuarios/tabelaUsuarios.php')
                                    alertify.alert('Usuario salvo com sucesso', 'Usuário salvo com sucesso!', function() {
                                        setTimeout(function() {
                                            window.location.href = "./usuarios.php";
                                        }, 1000);
                                    });


                                } else {
                                    alertify.alert('Erro ao salvar o usuário', 'Não foi possível salvar com sucesso!');
                                };
                            }
                        });
                    };
                };

            });

            $('#btnEditarUsuario').on('click', function() {
                $('#frmEdicaoUsuario').on('submit', function(evento) {
                    evento.preventDefault();
                });

                dados = $('#frmEdicaoUsuario').serialize();

                $.ajax({
                    type: "POST",
                    data: dados,
                    url: "../procedimentos/usuarios/editarUsuario.php",
                    success: function(r) {
                        alert(r);
                        if (r == 1) {
                            alert("Editado com sucesso");
                            $("#txtTipoUsuario").prop('disabled', true);
                            $("#btnEditarUsuario").prop('disabled', true);
                            alertify.notify('Usuário editado com sucesso', 'success', 2, function() {
                                location.reload();
                            });

                        } else {
                            alert("Erro ao editar");
                        }
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