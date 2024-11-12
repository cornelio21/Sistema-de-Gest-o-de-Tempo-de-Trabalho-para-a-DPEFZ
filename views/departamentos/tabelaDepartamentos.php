<?php
session_start();
require_once "../../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();
$sqlPesquisarDepartamentos = "SELECT idDepartamento, nomeDepartamento, numeroTotalFuncionarios, dataRegisto FROM departamentos";
$resultadoPesquisaDepartamentos = mysqli_query($conexao, $sqlPesquisarDepartamentos);

?>
<table class="table table-sm table-bordered">
    <thead class="table-dark">
        <th scope="col">#</th>
        <th scope="col">Nome departamento</th>
        <th scope="col">Total funcionários</th>
        <th scope="col">Data registo</th>
        <th scope="col">Ações</th>
    </thead>


    <?php while ($dados = mysqli_fetch_row($resultadoPesquisaDepartamentos)) : ?>
        <tr>
            <td><?php echo $dados[0]; ?></td>
            <td><?php echo $dados[1]; ?></td>
            <td><?php echo $dados[2]; ?></td>
            <td><?php echo $dados[3]; ?></td>
            <td>
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalMostrarDetalhesDepartamento" onclick="recuperarDadosDepartamentoDetalhados('<?php echo $dados[0]; ?>')">
                    Detalhes
                </button>
                <?php if (($_SESSION['idRoleUser'] == 1)) { ?>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdicaoDepartamento" onclick="recuperarDadosEdicaoDepartamento('<?php echo $dados[0]; ?>')">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmacaoExclusaoDepartamento" onclick="excluirDepartamento('<?php echo $dados[0]; ?>')">
                        <i class="fas fa-trash"></i>
                    </button>

                <?php } ?>
            </td>
        </tr>

    <?php endwhile; ?>

</table>