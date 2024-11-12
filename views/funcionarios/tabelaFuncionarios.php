<?php
session_start();
ini_set('display_errors', 1);

require_once "../../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sqlPesquisaFuncionarios = "SELECT f.idFuncionario, f.nomeFuncionario, f.cargo, f.escalaoFuncionario, f.classeFuncionario, YEAR(f.dataInicioCarreira), YEAR(f.dataNascimento), d.nomeDepartamento, f.dataRegisto from funcionarios as f inner join departamentos as d on f.idDepartamento = d.idDepartamento where f.isAposentado = 'Não'";
$resultadoPesquisaFuncionarios = mysqli_query($conexao, $sqlPesquisaFuncionarios);
?>
<div class="table-responsive">
    <table class="table table-sm table-bordered border-primary">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Cargo na direção</th>
                <th>Escalão</th>
                <th>Classe</th>
                <th>Anos serviço</th>
                <th>Idade</th>
                <th>Departamento</th>
                <th>Data registo</th>
                <th>Ações</th>

            </tr>
        </thead>

        <tbody class="table-striped">
            <?php
            while ($dadosPesquisaFuncionarios = mysqli_fetch_row($resultadoPesquisaFuncionarios)) : ?>
                <tr>
                    <td><?php echo $dadosPesquisaFuncionarios[0]; ?></td>
                    <td><?php echo $dadosPesquisaFuncionarios[1]; ?></td>
                    <td><?php echo $dadosPesquisaFuncionarios[2]; ?></td>
                    <td><?php echo $dadosPesquisaFuncionarios[3]; ?></td>
                    <td><?php echo $dadosPesquisaFuncionarios[4]; ?></td>
                    <td><?php echo (date('Y') - $dadosPesquisaFuncionarios[5]); ?></td>
                    <td><?php echo (date('Y') - $dadosPesquisaFuncionarios[6]) . " anos"; ?></td>
                    <td><?php echo $dadosPesquisaFuncionarios[7]; ?></td>
                    <td><?php echo $dadosPesquisaFuncionarios[8]; ?></td>
                    <td>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalMostrarDetalhesFuncionario" onclick="recuperarDadosDetalhadosFuncionario('<?php echo $dadosPesquisaFuncionarios[0]; ?>')">
                            Detalhes
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdicaoFuncionario" onclick="recuperarDadosFuncionario('<?php echo $dadosPesquisaFuncionarios[0]; ?>')">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <?php if (($_SESSION['idRoleUser'] == 1)) { ?>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmacaoExclusaoFuncionario" onclick="excluirFuncionario('<?php echo $dadosPesquisaFuncionarios[0]; ?>')">
                                <i class="fas fa-trash"></i>
                            </button>

                        <?php }; ?>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>
        </tbody>
    </table>
</div>