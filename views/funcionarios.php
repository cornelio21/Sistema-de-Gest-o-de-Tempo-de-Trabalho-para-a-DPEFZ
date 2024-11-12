<?php
session_start();
ini_set('display_errors', 1);
require_once "./dependencias.php";
require_once "../classes/conexao.php";

if (isset($_SESSION['usuario'])) {

    $con = new Conexao();
    $conexao = $con->conectar();

    $sqlPesquisaDepartamentos = "SELECT idDepartamento, nomeDepartamento from departamentos";
    $resultPesquisaDepartamentos = mysqli_query($conexao, $sqlPesquisaDepartamentos);



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
                <h1>Registos de funcionários</h1>
                <div class="row row-options">

                    <?php if (($_SESSION['idRoleUser'] == 1) || ($_SESSION['idRoleUser'] == 2)) { ?>
                        <span class="simple-label"><button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalRegistoFuncionario">Registar novo funcionário<i class="fas fa-plus-circle fa-fw fa-lg text-success"></i></button></span>
                    <?php }; ?>

                    <form id="frmPesquisaFuncionario" class="frm-pesquisa">
                      

                        <span>Pesquisa:</span>


                        <select id="itemsPesquisa" class="form-select ">
                            <option>Escolha o campo</option>
                            <option value="optionCodigoRegisto">Código de registo</option>
                            <option value="optionNomeFuncionario">Nome do funcionário</option>
                            <option value="optionCargo">Cargo que assume</option>
                            <option value="optionEscalao">Escalão</option>
                            <option value="optionClasse">Classe</option>
                            <option value="optionAnosServico">Anos de serviço</option>
                            <option value="optionIdade">Idade</option>
                            <option value="optionDepartamento">Departamento</option>
                            <option value="optionDataRegisto">Data de registo (ano-mês-dia)</option>
                        </select>



                        <input type="search" id="input-search" class="form-control" placeholder="Pesquise...">



                    </form>



                </div>



                <div class="row">
                    <div class="col-12">
                        <div id="tabelaFuncionariosLoad"></div>
                    </div>

                </div>
            </section>


        </main>



        <!-- MODALS -->

        <div class="modal fade " id="modalRegistoFuncionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRegistoFuncionario" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Registo de funcionário</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
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

                            <div class="col">

                                <span class="form-label">Gênero</span>

                                <div class="form-check form-check-inline form-check-genero">
                                    <label for="txtMasculino" class="form-check-label">Masculino</label>
                                    <input type="radio" name="txtGeneroFuncionario" id="txtMasculino" value="M" class="form-check-input">&nbsp;|&nbsp;
                                    <label for="txtFemenino" class="form-check-label">Femenino</label>
                                    <input type="radio" name="txtGeneroFuncionario" id="txtFemenino" value="F" class="form-check-input">
                                </div>


                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>



                            <div class="col-4">
                                <label for="txtDataNascimento" class="form-label">D. Nascimento</label>
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
                                <select class="form-select" name="txtDepartamento" id="txtDepartamento">
                                    <option selected>Escolha o departamento</option>
                                    <?php

                                    while ($dados = mysqli_fetch_row($resultPesquisaDepartamentos)) : ?>
                                        <option value="<?php echo $dados[0]; ?>"><?php echo $dados[1]; ?></option>
                                    <?php endwhile; ?>
                                </select>


                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>


                            <div class="col-4">
                                <label for="txtEscalao" class="form-label">Escalão</label>
                                <select class="form-select" name="txtEscalao" id="txtEscalao">
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
                                <select id="txtClasse" name="txtClasse" class="form-select">
                                    <option selected>Escolha a classe</option>
                                    <option value="C">C</option>
                                    <option value="B">B</option>
                                    <option value="A">A</option>
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
                                <label for="txtDataInicioCarreira" class="form-label">Inicio carreira</label>
                                <input type="date" name="txtDataInicioCarreira" id="txtDataInicioCarreira" class="form-control">


                                <div class="campo-invalido-vazio">
                                    <i class="fas fa-times"></i>Campo obrigatório!
                                </div>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-success btn-form" id="btnRegistarFuncionario">Salvar funcionário</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>

        <!-- MODAL EXCLUSAO -->

        <div class="modal fade" id="modalConfirmacaoExclusaoFuncionario" tabindex="-1" aria-labelledby="Exclusao de funcionário" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Deseja excluir?</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem a certeza que deseja mesmo excluir o funcionario?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnExcluirFuncionario"><i class="fas fa-trash"></i> Excluir</button>
                    </div>
                </div>
            </div>
        </div>




        <!-- MODAL EDICAO FUNCIONARIO -->

        <div class="modal fade" id="modalEdicaoFuncionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdicaoFuncionario" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h2 class="modal-title">Edição de funcionário</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"> </button>
                    </div>

                    <div class="modal-body">
                        <p>Escolha o que pretende fazer:</p>
                        <h3><i class="fas fa-angle-right"></i> Deseja editar dados pessoais do funcionário? :</h3>
                        <?php if (($_SESSION['idRoleUser'] == 3) || ($_SESSION['idRoleUser'] == 4)) { ?>
                            <label for="yesToEditPersonalDataFuncionario" class="form-label">Sim</label> <input type="radio" name="answerToEditPersonalDataFuncionario" id="yesToEditPersonalDataFuncionario" disabled>|
                            <label for="noToEditPersonalDataFuncionario" class="form-label">Não</label> <input type="radio" name="answerToEditPersonalDataFuncionario" id="noToEditPersonalDataFuncionario" disabled>
                        <?php } else { ?>
                            <label for="yesToEditPersonalDataFuncionario" class="form-label">Sim</label> <input type="radio" name="answerToEditPersonalDataFuncionario" id="yesToEditPersonalDataFuncionario">|
                            <label for="noToEditPersonalDataFuncionario" class="form-label">Não</label> <input type="radio" name="answerToEditPersonalDataFuncionario" id="noToEditPersonalDataFuncionario">
                        <?php }; ?>
                        <section id="area-edicao-dados-pessoais-funcionario">
                            <form id="frmEdicaoFuncionario" class="row" method="POST">
                                <div class="alert alert-danger alert-dismissible fade show error-fields-registo-funcionario" role="alert"><i class="fas fa-exclamation-triangle"></i> Preencha os campos que são obrigatórios
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                <div class="col-12">
                                    <label for="txtIdFuncionarioEdicao" class="form-label">Código</label>
                                    <input type="text" name="txtIdFuncionarioEdicao" id="txtIdFuncionarioEdicao" class="form-control" readonly>

                                </div>

                                <div class="col-12">
                                    <label for="txtNomeFuncionarioEdicao" class="form-label">Nome completo</label>
                                    <input type="text" name="txtNomeFuncionarioEdicao" id="txtNomeFuncionarioEdicao" class="form-control" placeholder="Nome completo do funcionário">

                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label for="txtDataNascimentoEdicao" class="form-label">D. Nascimento</label>
                                    <input type="date" id="txtDataNascimentoEdicao" name="txtDataNascimentoEdicao" class="form-control">


                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>

                                </div>

                                <div class="col-4">
                                    <label for="txtBI" class="form-label">Nº BI</label>
                                    <input type="text" name="txtBIEdicao" id="txtBIEdicao" placeholder="Nº de BI" class="form-control" maxlength="13" minlength="13">

                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>

                                </div>

                                <div class="col-4">
                                    <label for="txtNUIT" class="form-label">Nº NUIT</label>
                                    <input type="text" name="txtNUITEdicao" id="txtNUITEdicao" placeholder="NUIT" class="form-control" maxlength="9" minlength="9">


                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>
                                </div>




                                <div class="col-4">
                                    <label for="txtDepartamentoEdicao" class="form-label">Departamento <span class="font-weight-normal">(Actual: <span id="departamentoActual"></span>)</span></label>
                                    <select class="form-select" name="txtDepartamentoEdicao" id="txtDepartamentoEdicao">
                                        <option selected value="" id="fake-option-selected">Escolha o departamento</option>

                                        <?php
                                        $sqlPesquisaDepartamentos = "SELECT idDepartamento, nomeDepartamento from departamentos";
                                        $resultPesquisaDepartamentos = mysqli_query($conexao, $sqlPesquisaDepartamentos);
                                        while ($dados = mysqli_fetch_row($resultPesquisaDepartamentos)) : ?>
                                            <option value="<?php echo $dados[0]; ?>"><?php echo $dados[1]; ?></option>
                                        <?php endwhile; ?>
                                    </select>


                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>
                                </div>


                                <div class="col-4">
                                    <label for="txtEscalao" class="form-label">Escalão</label>
                                    <input type="text" name="txtEscalaoEdicao" id="txtEscalaoEdicao" class="form-control" disabled readonly>
                                </div>

                                <div class="col-4">
                                    <label for="txtClasse" class="form-label">Classe</label>
                                    <input type="text" name="txtClasseEdicao" id="txtClasseEdicao" class="form-control" disabled readonly>

                                </div>

                                <div class="col-4">
                                    <label for="txtCargoEdicao" class="form-label">Cargo</label>
                                    <input type="text" name="txtCargoEdicao" id="txtCargoEdicao" class="form-control" placeholder="Cargo do funcionário">


                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label for="txtDataInicioCarreira" class="form-label">Inicio carreira</label>
                                    <input type="date" name="txtDataInicioCarreiraEdicao" id="txtDataInicioCarreiraEdicao" class="form-control" readonly disabled>



                                </div>

                                <div class="col-4 mt-5">
                                    <button type="submit" class="btn btn-success btn-form" id="btnEditarFuncionario">Salvar funcionário</button>, ou <button class="btn btn-link btn-link-close">Cancelar</button>
                                </div>

                            </form>
                        </section>
                        <hr>
                        <h3><i class="fas fa-angle-right"></i> Deseja promover o funcionário? :</h3>
                        <?php if ($_SESSION['idRoleUser'] == 3) { ?>
                            <label for="yesToPromoveFuncionario" class="form-label">Sim<input disabled type="radio" name="answerToPromoveFuncionario" id="yesToPromoveFuncionario"></label> |
                            <label for="noToPromoveFuncionario" class="form-label">Não<input disabled type="radio" name="answerToPromoveFuncionario" id="noToPromoveFuncionario"></label>
                        <?php } else { ?>
                            <label for="yesToPromoveFuncionario" class="form-label">Sim<input type="radio" name="answerToPromoveFuncionario" id="yesToPromoveFuncionario"></label> |
                            <label for="noToPromoveFuncionario" class="form-label">Não<input type="radio" name="answerToPromoveFuncionario" id="noToPromoveFuncionario"></label>
                        <?php }; ?>
                        <section id="area-promocao-funcionario">
                            <form id="frmPromocaoFuncionario">

                                <input type="hidden" name="idFuncionarioPromocao" id="idFuncionarioPromocao">
                                <div class="col-4">
                                    <label for="classeActualFuncionario" class="form-label">Classe actual do funcionario </label>
                                    <input type="text" name="classeActualFuncionario" id="classeActualFuncionario" class="form-control" readonly disabled>

                                </div>

                                <div class="col-4">
                                    <label for="txtClasseActualizacao" class="form-label">Escolha a nova classe do funcionário </label>
                                    <select id="txtClasseActualizacao" name="txtClasseActualizacao" class="form-select">
                                        <option value="">Escolha a nova classe</option>
                                        <option value="C">C</option>
                                        <option value="B">B</option>
                                        <option value="A">A</option>
                                    </select>


                                    <div class="campo-invalido-vazio">
                                        <i class="fas fa-times"></i>Campo obrigatório!
                                    </div>

                                </div>
                                <div class="col-4">
                                    <button class="btn btn-success" id="btnActualizarClasse">
                                        Actualizar dados
                                    </button>, ou <button class="btn btn-link btn-link-close">Cancelar</button>
                                </div>
                            </form>
                        </section>

                        <hr>
                        <h3><i class="fas fa-angle-right"></i> Deseja progredir o funcionário? :</h3>
                        <?php if ($_SESSION['idRoleUser'] == 3) { ?>
                            <label for="yesToProgredeFuncionario" class="form-label">Sim<input type="radio" name="answerToProgredeFuncionario" id="yesToProgredeFuncionario" disabled></label> |
                            <label for="noToProgredeFuncionario" class="form-label">Não<input type="radio" name="answerToProgredeFuncionario" id="noToProgredeFuncionario" disabled></label>
                        <?php } else { ?>
                            <label for="yesToProgredeFuncionario" class="form-label">Sim<input type="radio" name="answerToProgredeFuncionario" id="yesToProgredeFuncionario"></label> |
                            <label for="noToProgredeFuncionario" class="form-label">Não<input type="radio" name="answerToProgredeFuncionario" id="noToProgredeFuncionario"></label>
                        <?php }; ?>
                        <section id="area-progressao-funcionario">
                            <form id="frmProgressaoFuncionario">


                                <div class="col-4">
                                    <label for="escalaoActualFuncionario" class="form-label">Escalão actual do funcionario </label>
                                    <input type="text" name="escalaoActualFuncionario" id="escalaoActualFuncionario" class="form-control" disabled>
                                    <input type="hidden" name="idFuncionarioProgressao" id="idFuncionarioProgressao">
                                </div>



                                <div class="col-4">
                                    <label for="txtEscalaoActualizacao" class="form-label">Escolha o novo escalão do funcionário </label>
                                    <select id="txtEscalaoActualizacao" name="txtEscalaoActualizacao" class="form-select">
                                        <option value="">Escolha o novo escalão</option>
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
                                    <button class="btn btn-success" id="btnActualizarEscalao">
                                        Actualizar dados
                                    </button>, ou <button class="btn btn-link btn-link-close">Cancelar</button>
                                </div>
                            </form>
                        </section>

                        <hr>
                        <h3><i class="fas fa-angle-right"></i> Aposentar funcionário? :</h3>
                        <?php if ($_SESSION['idRoleUser'] == 4) { ?>
                            <label for="yesToAposentarFuncionario" class="form-label">Sim<input type="radio" name="answerToAposentarFuncionario" id="yesToAposentarFuncionario" disabled></label> |
                            <label for="noToAposentarFuncionario" class="form-label">Não<input type="radio" name="answerToAposentarFuncionario" id="noToAposentarFuncionario" disabled></label>
                        <?php } else { ?>
                            <label for="yesToAposentarFuncionario" class="form-label">Sim<input type="radio" name="answerToAposentarFuncionario" id="yesToAposentarFuncionario"></label> |
                            <label for="noToAposentarFuncionario" class="form-label">Não<input type="radio" name="answerToAposentarFuncionario" id="noToAposentarFuncionario"></label>
                        <?php }; ?>
                        <section id="area-aposentar-funcionario">


                            <div class="col-4">
                                <p><span class="label-details">Idade do funcionário: </span> <span id="idadeFuncionario"></span></p>
                                <p><span class="label-details">Anos de serviço prestados: </span> <span id="anosServicoFuncionario"></span></p>
                            </div>


                            <form id="frmAposentarFuncionario">

                                <p class="text-danger font-bold">(A opção "SIM" só será válida apenas se a IDADE e os ANOS DE SERVIÇO permitirem que o mesmo se aposente)</p>
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="idFuncionarioAposentadoria" id="idFuncionarioAposentadoria">
                                    <input type="hidden" name="idadeFuncionarioAposentadoria" id="idadeFuncionarioAposentadoria" disabled>
                                    <input type="hidden" name="generoFuncionarioAposentadoria" id="generoFuncionarioAposentadoria" disabled>
                                    <input type="hidden" name="anosServicoFuncionarioAposentadoria" id="anosServicoFuncionarioAposentadoria" disabled>
                                    <label for="yesTotxtRespostaAposentadoria" class="form-check-label">Sim</label>
                                    <input type="radio" name="txtRespostaAposentadoria" id="yesTotxtRespostaAposentadoria" class="form-check-input" value="Sim">
                                </div>

                                <div class="form-check form-check-inline">
                                    <label for="noTotxtRespostaAposentadoria" class="form-check-label">Não</label>
                                    <input type="radio" name="txtRespostaAposentadoria" id="noTotxtRespostaAposentadoria" class="form-check-input" value="Não">
                                </div>


                                <div class="col-4">
                                    <button type="submit" class="btn btn-success" id="btnAposentarFuncionario">Actualizar dados</button>, ou <button class="btn btn-link btn-link-close">Cancelar</button>
                                </div>

                            </form>



                        </section>



                    </div>

                </div>
            </div>

        </div>


        <!-- MODAL DADOS DETALHADOS -->
        <div class="modal fade" id="modalMostrarDetalhesFuncionario">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Dados detalhados de funcionário</h2>
                    </div>

                    <div class="modal-body">
                        <p><span class="label-details">Código de registo: </span> <span id="codigoRegistoFuncionario"></span></p>
                        <p> <span class="label-details">Nome completo: </span> <span id="nomeFuncionario"></span></p>
                        <p> <span class="label-details">Genêro do funcionário(a): </span> <span id="generoFuncionario"></span></p>
                        <p><span class="label-details">Data de nascimento / idade: </span> <span id="dataNascimento"></span> / <span id="idadeFuncionario"></span> anos</p>
                        <p><span class="label-details">Número de NUIT: </span> <span id="numeroNUITFuncionario"></span></p>
                        <p><span class="label-details">Número de bilhete de identidade:</span> <span id="numeroBIFuncionario"></span></p>
                        <p><span class="label-details">Escalão: </span><span id="escalaoFuncionario"></span></p>
                        <p><span class="label-details">Classe: </span><span id="classeFuncionario"></span></p>
                        <p><span class="label-details">Cargo: </span><span id="cargoFuncionario"></span></p>
                        <p><span class="label-details">Departamento a que pertence: </span><span id="departamentoFuncionario"></span></p>
                        <p><span class="label-details">Data de inicio carreira / anos de trabalho: </span><span id="dataCarreirafuncionario"></span> / <span id="anosServicoFuncionario"></span> anos</p>
                        <p><span class="label-details">Aposentado?: </span> <span id="isAposentadoFuncionario"></span></p>
                        <p><span class="label-details">Usuário de sistema?: </span><span id="isUserSystemFuncionario"></span></p>
                        <p><span class="label-details">Data de registo: </span> <span id="dataRegistoFuncionario"></span></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function excluirFuncionario(idFuncionario) {

                $('#btnExcluirFuncionario').on('click', function() {
                    $.ajax({
                        type: "POST",
                        data: "idFuncionario=" + idFuncionario,
                        url: "../procedimentos/funcionarios/excluirFuncionario.php",
                        success: function(r) {

                            if (r == 1) {
                                $("#btnExcluirFuncionario").prop('disabled', true);
                                alertify.notify('Funcionario excluído com sucesso ', 'success', 2, function() {
                                    location.reload();
                                });
                            } else {
                                alertify.notify('Erro ao excluir', 'error', 2, function() {
                                    location.reload();
                                });
                            }
                        }
                    })


                });
            };

            function recuperarDadosFuncionario(idFuncionario) {
                $.ajax({
                    type: "POST",
                    data: "idFuncionario=" + idFuncionario,
                    url: "../procedimentos/funcionarios/recuperarDadosFuncionario.php",
                    success: function(r) {

                        dados = jQuery.parseJSON(r);


                        $('#txtIdFuncionarioEdicao').val(dados['idFuncionario']);
                        $('#txtNomeFuncionarioEdicao').val(dados['nomeFuncionario']);
                        $('#txtDataNascimentoEdicao').val(dados['dataNascimento']);
                        $('#txtBIEdicao').val(dados['numeroBI']);
                        $('#txtNUITEdicao').val(dados['numeroNUIT']);
                        $('#txtEscalaoEdicao').val(dados['escalao']);
                        $('#txtClasseEdicao').val(dados['classe']);
                        $('#escalaoActualFuncionario').val(dados['escalao']);
                        $('#classeActualFuncionario').val(dados['classe']);
                        $('#txtCargoEdicao').val(dados['cargo']);
                        $('#txtDataInicioCarreiraEdicao').val(dados['dataInicioCarreira']);
                        var departamento = dados['nomeDepartamento'];
                        departamento.replace("Departamento", "");
                        $('#departamentoActual').text(departamento);
                        $('#idFuncionarioPromocao').val(dados['idFuncionario']);
                        $('#idFuncionarioProgressao').val(dados['idFuncionario']);
                        $('#idadeFuncionario').text(dados['idadeFuncionario'] + " anos");
                        $('#anosServicoFuncionario').text(dados['anosServico'] + " anos");

                        $('#idFuncionarioAposentadoria').val(dados['idFuncionario']);
                        $('#idadeFuncionarioAposentadoria').val(dados['idadeFuncionario']);
                        $('#anosServicoFuncionarioAposentadoria').val(dados['anosServico']);
                        $('#generoFuncionarioAposentadoria').val(dados['generoFuncionario']);

                    },
                })
            }

            function recuperarDadosDetalhadosFuncionario(idFuncionario) {
                $.ajax({
                    type: "POST",
                    data: "idFuncionario=" + idFuncionario,
                    url: "../procedimentos/funcionarios/recuperarDadosDetalhadosFuncionario.php",
                    success: function(r) {

                        dados = jQuery.parseJSON(r);
                        console.log(dados);
                        $('#codigoRegistoFuncionario').text(dados['idFuncionario']);
                        $('#nomeFuncionario').text(dados['nomeFuncionario']);
                        $('#dataNascimento').text(dados['dataNascimento']);
                        $('#idadeFuncionario').text(dados['idadeFuncionario']);
                        $('#numeroNUITFuncionario').text(dados['numeroNUIT']);
                        $('#numeroBIFuncionario').text(dados['numeroBI']);
                        $('#escalaoFuncionario').text(dados['escalao']);
                        $('#classeFuncionario').text(dados['classe']);
                        $('#cargoFuncionario').text(dados['cargo']);
                        $('#dataCarreirafuncionario').text(dados['dataInicioCarreira']);
                        $('#departamentoFuncionario').text(dados['nomeDepartamento']);
                        $('#anosServicoFuncionario').text(dados['anosServico']);
                        $('#isAposentadoFuncionario').text(dados['isAposentado']);
                        $('#isUserSystemFuncionario').text(dados['isUserSystem']);
                        $('#dataRegistoFuncionario').text(dados['dataRegisto']);
                        $('#generoFuncionario').text(dados['generoFuncionario']);


                    },
                });
            }




            $(document).ready(function() {
                $('#tabelaFuncionariosLoad').load('./funcionarios/tabelaFuncionarios.php');




                $('#itemsPesquisa').on('change', function() {

                    if ($('#itemsPesquisa option').filter(':selected').val() == "optionCodigoRegisto") {

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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionNomeFuncionario") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionCargo") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionEscalao") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionClasse") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionAnosServico") {
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
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionIdade") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(6).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionDepartamento") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(7).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    } else if ($('#itemsPesquisa option').filter(':selected').val() == "optionDataRegisto") {
                        $('#input-search').on('keyup', function() {
                            var value = $(this).val();

                            $('table tr').each(function(result) {
                                if (result != 0) {
                                    var id = $(this).children("td").eq(8).text();
                                    if (id.indexOf(value) !== 0 && id.toLowerCase().indexOf(value.toLowerCase()) < 0) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    };
                                }
                            })
                        });
                    };



                });



                $('#yesToEditPersonalDataFuncionario').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-edicao-dados-pessoais-funcionario').fadeIn('fast');
                        }, 150);
                    }
                });

                $('#yesToEditPersonalDataFuncionario').on('click', function() {
                    if ($(this).prop("disabled") == true) {
                        alert("clicou");
                    }
                });

                $('#noToEditPersonalDataFuncionario').on('change', function() {
                    setTimeout(function() {
                        $('#area-edicao-dados-pessoais-funcionario').fadeOut('fast');
                    }, 150);
                });

                $('#yesToPromoveFuncionario').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-promocao-funcionario').fadeIn('fast');
                        }, 150);
                    };
                });


                $('#noToPromoveFuncionario').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-promocao-funcionario').fadeOut('fast');
                        }, 150);
                    };
                });


                $('#yesToProgredeFuncionario').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-progressao-funcionario').fadeIn('fast');
                        }, 150);
                    };
                });


                $('#noToProgredeFuncionario').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-progressao-funcionario').fadeOut('fast');
                        }, 150);
                    };
                });



                $('#yesToAposentarFuncionario').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-aposentar-funcionario').fadeIn('fast');
                        }, 150);
                    };
                });


                $('#noToAposentarFuncionario').on('change', function() {
                    if ($(this).prop("checked") == true) {
                        setTimeout(function() {
                            $('#area-aposentar-funcionario').fadeOut('fast');
                        }, 150);
                    };
                });


                $('#area-edicao-dados-pessoais-funcionario .btn-link-close').on('click', function() {
                    $('#frmEdicaoFuncionario').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    $('#area-edicao-dados-pessoais-funcionario').fadeOut('fast');

                    $('#yesToEditPersonalDataFuncionario').prop("checked", false);
                });

                $('#area-promocao-funcionario .btn-link-close').on('click', function() {
                    $('#frmPromocaoFuncionario').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    $('#area-promocao-funcionario').fadeOut('fast');

                    $('#yesToPromoveFuncionario').prop("checked", false);
                });

                $('#area-progressao-funcionario .btn-link-close').on('click', function() {
                    $('#frmProgressaoFuncionario').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    $('#area-progressao-funcionario').fadeOut('fast');

                    $('#yesToProgredeFuncionario').prop("checked", false);
                });


                $('#area-aposentar-funcionario .btn-link-close').on('click', function() {
                    $('#frmAposentarFuncionario').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    $('#area-aposentar-funcionario').fadeOut('fast');

                    $('#yesToAposentarFuncionario').prop("checked", false);
                });


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
                    generoFuncionario = $('input[name="txtGeneroFuncionario"]');

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


                    if (isNotEmpty(nomeFuncionario) && isNotEmpty(dataNascimento) && isNotEmpty(numeroBI) && isNotEmpty(numeroNUIT) && isNotEmpty(departamento) && isNotEmpty(escalao) && isNotEmpty(classe) && isNotEmpty(cargo) && isNotEmpty(dataInicioCarreira)) {
                        let dados = $('#frmRegistoFuncionario').serialize();
                        console.log(dados);
                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: '../procedimentos/funcionarios/adicionarFuncionario.php',
                            success: function(r) {

                                if (r == 1) {
                                    nomeFuncionario.prop('disabled', true);
                                    dataNascimento.prop('disabled', true);
                                    numeroBI.prop('disabled', true);
                                    numeroNUIT.prop('disabled', true);
                                    departamento.prop('disabled', true);
                                    escalao.prop('disabled', true);
                                    classe.prop('disabled', true);
                                    cargo.prop('disabled', true);
                                    dataInicioCarreira.prop('disabled', true);
                                    generoFuncionario.prop('disabled', true);
                                    $('#btnRegistarFuncionario').prop('disabled', true);
                                    alertify.notify('Funcionário registado com sucesso', 'success', 2, function() {
                                        location.reload();
                                    });

                                } else {
                                    alertify.alert('Erro ao salvar o funcionário', 'Não foi possível salvar com sucesso!');
                                };
                            }
                        });




                    };




                });


                $('#btnEditarFuncionario').on('click', function() {
                    $('#frmEdicaoFuncionario').on('submit', function(evento) {
                        evento.preventDefault();
                    });
                    dados = $('#frmEdicaoFuncionario').serialize();

                    nomeFuncionario = $('#txtNomeFuncionarioEdicao');
                    dataNascimento = $('#txtDataNascimentoEdicao');
                    numeroBI = $('#txtBIEdicao');
                    numeroNUIT = $('#txtNUITEdicao');
                    departamento = $('#txtDepartamentoEdicao');
                    cargo = $('#txtCargoEdicao');
                    dataInicioCarreira = $('#txtDataInicioCarreiraEdicao');

                    function isNotEmpty(field) {
                        if (field.val() == "") {
                            $('.error-fields-registo-funcionario').fadeIn('fast');
                            field.css('border', 'solid 2px #dc3545');
                            $('#frmEdicaoFuncionario .campo-invalido-vazio').fadeIn('slow');
                            return false;
                        } else {
                            field.css('border', 'solid 2px #198754');
                            return true;
                        }
                    };

                    if (isNotEmpty(nomeFuncionario) && isNotEmpty(dataNascimento) && isNotEmpty(numeroBI) && isNotEmpty(numeroNUIT) && isNotEmpty(departamento) && isNotEmpty(cargo) && isNotEmpty(dataInicioCarreira)) {
                        dados = $('#frmEdicaoFuncionario').serialize();
                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "../procedimentos/funcionarios/editarFuncionario.php",
                            success: function(r) {
                                alert(r);
                                if (r == 1) {
                                    $("#txtIdDepartamentoEdicao").prop('disabled', true);
                                    $("#btnEdicaoDepartamento").prop('disabled', true);
                                    alertify.notify('Departamento editado com sucesso', 'success', 2, function() {
                                        location.reload();
                                    });

                                } else {
                                    alert("erro ao editar");
                                }
                            }
                        });

                    }
                });

                $('#btnActualizarClasse').on('click', function() {

                    $('#frmPromocaoFuncionario').on('submit', function(evento) {
                        event.preventDefault();
                    });

                    classeActualizacao = $('#txtClasseActualizacao');

                    function isNotEmpty(field) {
                        if (field.val() == "") {
                            $('.error-fields-registo-funcionario').fadeIn('fast');
                            field.css('border', 'solid 2px #dc3545');
                            $('#frmPromocaoFuncionario .campo-invalido-vazio').fadeIn('slow');
                            return false;
                        } else {
                            field.css('border', 'solid 2px #198754');
                            return true;
                        }
                    };


                    dados = $('#frmPromocaoFuncionario').serialize();

                    if (isNotEmpty(classeActualizacao)) {
                        console.log(dados);
                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "../procedimentos/funcionarios/promoverFuncionario.php",
                            success: function(r) {

                                if (r == 1) {
                                    $("#txtClasseActualizacao").prop('disabled', true);
                                    $("#btnActualizarClasse").prop('disabled', true);
                                    alertify.notify('Funcionário promovido com sucesso', 'success', 2, function() {
                                        location.reload();
                                    });
                                } else {
                                    alert('Erro ao promover o funcionario');
                                }
                            },
                        });
                    };




                });

                $('#btnActualizarEscalao').on('click', function() {

                    $('#frmProgressaoFuncionario').on('submit', function(evento) {
                        evento.preventDefault();
                    });


                    function isNotEmpty(field) {
                        if (field.val() == "") {
                            $('.error-fields-registo-funcionario').fadeIn('fast');
                            field.css('border', 'solid 2px #dc3545');
                            $('#frmProgressaoFuncionario .campo-invalido-vazio').fadeIn('slow');
                            return false;
                        } else {
                            field.css('border', 'solid 2px #198754');
                            return true;
                        }
                    };

                    escalaoFuncionario = $('#txtEscalaoActualizacao');
                    dados = $('#frmProgressaoFuncionario').serialize();
                    console.log(dados);

                    if (isNotEmpty(escalaoFuncionario)) {
                        $.ajax({
                            type: "POST",
                            data: dados,
                            url: "../procedimentos/funcionarios/progredirFuncionario.php",
                            success: function(r) {

                                if (r == 1) {
                                    $("#txtEscalaoActualizacao").prop('disabled', true);
                                    $("#btnActualizarEscalao").prop('disabled', true);
                                    alertify.notify('Funcionário progredido com sucesso', 'success', 2, function() {
                                        location.reload();
                                    });
                                } else {
                                    alert('erro');
                                };
                            }
                        })
                    };
                });

                $('#btnAposentarFuncionario').on('click', function() {
                    $('#frmAposentarFuncionario').on('submit', function(evento) {
                        evento.preventDefault();
                    });

                    dados = $('#frmAposentarFuncionario').serialize();

                    if ($('#yesTotxtRespostaAposentadoria').prop("checked") == true) {
                        console.log(dados);
                        if (($('#idadeFuncionarioAposentadoria').val() >= 60 && $('#generoFuncionarioAposentadoria').val() == "M") || ($('#idadeFuncionarioAposentadoria').val() >= 55 && $('#generoFuncionarioAposentadoria').val() == "F")) {
                            $.ajax({
                                type: "POST",
                                data: dados,
                                url: "../procedimentos/funcionarios/aposentarFuncionario.php",
                                success: function(r) {
                                    alert(r);
                                    if (r == 1) {
                                        $("#txtRespostaAposentadoria").prop('disabled', true);
                                        $("#btnAposentarFuncionario").prop('disabled', true);
                                        alertify.notify('Funcionário aposentado com sucesso', 'success', 2, function() {
                                            location.reload();
                                        });
                                    } else {
                                        alert("erro ao aposentaer");
                                    }
                                }
                            });

                        } else {
                            alert("NAO PODE APOSENTAR");
                        }
                    };

                    if ($('#noTotxtRespostaAposentadoria').prop("checked") == true) {

                        $('#area-aposentar-funcionario').fadeOut('fast');

                        $('#yesToAposentarFuncionario').prop("checked", false);

                        $('#noTotxtRespostaAposentadoria').prop("checked", false);

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