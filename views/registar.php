<?php
require_once "./dependencias.php";
require_once "../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sql = "SELECT * from usuarios where idRole_Users = 1";
$result = mysqli_query($conexao, $sql);

$validar = 0;
if(mysqli_fetch_row($result) > 0){
    header("location:../index.php");
}

?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

    <title>Registo | SIGETES</title>
</head>

<body>

    <main>
        <div class="container">
            <h1>Registo de Super Administrador do sistema</h1>

            <section>

                <h2>Registo de funcionário</h2>
                <form id="frmRegistoFuncionario" class="row" method="POST">
                    <div class="alert alert-danger alert-dismissible fade show error-fields-registo-funcionario" role="alert"><i class="fas fa-exclamation-triangle"></i> Preencha os campos que são obrigatórios
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="col-12">
                        <label for="txtNomeFuncionario" class="form-label">Nome completo</label>
                        <input type="text" name="txtNomeFuncionario" id="txtNomeFuncionario" class="form-control" placeholder="Nome completo do funcionário">

                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="txtDataNascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" id="txtDate" name="txtDate" class="form-control">


                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>

                    </div>

                    <div class="col-4">
                        <label for="txtBI" class="form-label">Nº BI</label>
                        <input type="text" name="txtBI" id="txtBI" placeholder="Nº de BI" class="form-control" maxlength="13" minlength="13">

                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>

                    </div>

                    <div class="col-4">
                        <label for="txtNUIT" class="form-label">Nº NUIT</label>
                        <input type="text" name="txtNUIT" id="txtNUIT" placeholder="NUIT" class="form-control" maxlength="9" minlength="9">


                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>
                    </div>




                    <div class="col-4">
                        <label for="txtDepartamento" class="form-label">Departamento</label>
                        <select class="form-control" name="txtDepartamento" id="txtDepartamento">
                            <option selected>Escolha o departamento</option>
                            <?php
                            $sql_pesquisa_departamentos = "SELECT idDepartamento, nomeDepartamento from departamentos";
                            $resultado_pesquisa_departamentos = mysqli_query($conexao, $sql_pesquisa_departamentos);
                            while ($dados = mysqli_fetch_row($resultado_pesquisa_departamentos)) : ?>
                                <option value="<?php echo $dados[0]; ?>"><?php echo $dados[1]; ?></option>
                            <?php endwhile; ?>
                        </select>


                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>
                    </div>


                    <div class="col-4">
                        <label for="txtEscalao" class="form-label">Escalão</label>
                        <select class="form-control" name="txtEscalao" id="txtEscalao">
                            <option selected>Escolha o escalão</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>


                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="txtClasse" class="form-label">Classe</label>
                        <select id="txtClasse" name="txtClasse" class="form-control">
                            <option selected>Escolha a classe</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>


                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="txtCargo" class="form-label">Cargo</label>
                        <input type="text" name="txtCargo" id="txtCargo" class="form-control" placeholder="Cargo do funcionário">


                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="txtDataInicioCarreira" class="form-label">Data inicio carreira</label>
                        <input type="date" name="txtDataInicioCarreira" id="txtDataInicioCarreira" class="form-control">


                        <div class="campo-invalido-vazio">
                            <i class="fas fa-times"></i>Campo obrigatório!
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn form-btn btn-success" id="btnRegistarFuncionario">Salvar funcionário</button>
                    </div>

                </form>
                <hr>

                <h2>Será usuário de sistema?</h2>
                <div class="col-12">
                    <label for="txtYesIsUserSystem" class="form-label">Sim<input type="radio" name="txtUserROLE" id="txtYesIsUserSystem" value="Sim"></label>

                    <label for="txtIsNotUserSystem" class="form-label">Não<input type="radio" name="txtUserROLE" id="txtIsNotUserSystem" value="Nao"></label>
                </div>

                <form id="frmRegistoUsuario" class="row" method="POST">
                    <section id="inputs-user-data">
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
                                $sql_pesquisa_funcionarios = "SELECT f.idFuncionario, f.nomeFuncionario, d.nomeDepartamento from funcionarios as f join departamentos as d on f.idDepartamento = d.idDepartamento";
                                $resultado_pesquisa_funcionarios = mysqli_query($conexao, $sql_pesquisa_funcionarios);

                                while ($dados = mysqli_fetch_row($resultado_pesquisa_funcionarios)) : ?>

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
                                $sql_pesquisa_ROLE_USERS = "SELECT idROLE_USER, tipoROLE_USER from ROLE_USERS;";
                                $resultado_pesquisa_ROLE_USERS = mysqli_query($conexao, $sql_pesquisa_ROLE_USERS);
                                while ($dados = mysqli_fetch_row($resultado_pesquisa_ROLE_USERS)) : {
                                        if ($dados[1] == "super-admin") { ?>

                                            <option value="<?php echo $dados[0]; ?>"><?php echo $dados[1]; ?></option>
                                        <?php
                                        } else { ?>
                                            <option disabled value="<?php echo $dados[0]; ?>"><?php echo $dados[1]; ?></option>
                                <?php }
                                    }

                                endwhile; ?>
                            </select>


                            <div class="campo-invalido-vazio">
                                <i class="fas fa-times"></i>Campo obrigatório!
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="txtSenha" class="form-label">Digite a senha do usuário</label>
                            <input type="password" name="txtSenha" id="txtSenha" class="form-control" placeholder="Digite uma senha">

                            <div class="campo-invalido-vazio">
                                <i class="fas fa-times"></i>Campo obrigatório!
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="txtSenhaConfirmacao" class="form-label">Volte a digitar a senha</label>
                            <input type="password" id="txtSenhaConfirmacao" class="form-control" placeholder="Volte a digitar uma senha">

                            <div class="campo-invalido-vazio">
                                <i class="fas fa-times"></i>Campo obrigatório!
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn form-btn btn-success" id="btnRegistarUsuario">Salvar usuário</button>
                        </div>

                    </section>
                </form>
        </div>


        </section>


        </div>
    </main>


    <script>
        $(document).ready(function() {

            $('#btnRegistarFuncionario').on('click', function() {

                $('#frmRegistoFuncionario').on('submit', function(evento) {
                    evento.preventDefault();
                });

                nomeFuncionario = $('#txtNomeFuncionario');
                dataNascimento = $('#txtDate');
                numeroBI = $('#txtBI');
                numeroNUIT = $('#txtNUIT');
                departamento = $('#txtDepartamento');
                escalao = $('#txtEscalao');
                classe = $('#txtClasse');
                cargo = $('#txtCargo');
                dataInicioCarreira = $('#txtDataInicioCarreira');

                function isNotEmpty(field) {
                    if (field.val() == "") {
                        $('.error-fields-registo-funcionario').fadeIn('fast');
                        field.css('border', 'solid 2px #dc3545');
                        $('#frmRegistoFuncionario .campo-invalido-vazio').fadeIn('slow');
                        return false;
                    } else {
                        field.css('border', 'solid 2px #198754');
                        return true;
                    }
                };

                // localStorage.setItem("dados", $('#frmRegistoFuncionario').html());



                if (isNotEmpty(nomeFuncionario) && isNotEmpty(dataNascimento) && isNotEmpty(numeroBI) && isNotEmpty(numeroNUIT) && isNotEmpty(departamento) && isNotEmpty(escalao) && isNotEmpty(classe) && isNotEmpty(cargo) && isNotEmpty(dataInicioCarreira)) {
                    let dados = $('#frmRegistoFuncionario').serialize();
                    console.log(dados);
                    $.ajax({
                        type: "POST",
                        data: dados,
                        url: '../procedimentos/funcionarios/adicionarFuncionario.php',
                        success: function(r) {
                            
                            if (r == 1) {

                                alertify.alert('Funcionário salvo com sucesso', 'Funcionário salvo com sucesso! Registe-o como usuário super-admin do sistema no formulário seguinte', function() {
                                    location.reload();
                                });

                                // alertify.notify('Funcionário salvo com sucesso. Registe-o como usuário super-Admin', 'custom', 5);

                            } else {
                                alertify.alert('Erro ao salvar o funcionário', 'Não foi possível salvar com sucesso!');
                            };
                        }
                    });




                };
            });






            $('#txtYesIsUserSystem').on('change', function() {
                if ($(this).prop("checked") == true) {
                    setTimeout(function() {
                        $('#inputs-user-data').fadeIn('slow');
                        window.location.href = "#inputs-user-data";
                    }, 150);

                };
            });

            $('#txtIsNotUserSystem').on('change', function() {
                if ($(this).prop("checked") == true) {
                    setTimeout(function() {
                        $('#inputs-user-data').fadeOut('fast');
                        window.location.href = "#frmRegistoFuncionario";
                    }, 150);

                };
            });

            $('#btnRegistarUsuario').on('click', function() {

                $('#frmRegistoUsuario').on('submit', function(evento) {
                    evento.preventDefault();
                })

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
                        $('#inputs-user-data .campo-invalido-vazio').fadeIn('slow');
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
                                    alertify.alert('Usuario salvo com sucesso', 'Usuário salvo com sucesso!', function() {
                                        setTimeout(function() {
                                            window.location.href = "../index.php";
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




        });
    </script>

</body>

</html>