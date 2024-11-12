<?php
session_start();
require_once "../../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sqlPesquisaChefesDepartamentos = "SELECT c.idFuncionarios_chefes_departamentos, f.nomeFuncionario, d.nomeDepartamento, c.dataRegisto FROM funcionarios_chefes_departamentos as c inner join funcionarios as f on c.idFuncionario = f.idFuncionario inner join departamentos as d on c.idDepartamento = d.idDepartamento";
$resultadoPesquisaChefesDepartamentos = mysqli_query($conexao, $sqlPesquisaChefesDepartamentos);

?>
<table class="table table-sm table-bordered">
    <thead class="table-dark">
        <th scope="col">#</th>
        <th scope="col">Nome do departamento</th>
        <th scope="col">Chefe</th>
        <th scope="col">Data registo</th>
        <th scope="col">Ações</th>
    </thead>


    <?php while ($dados = mysqli_fetch_row($resultadoPesquisaChefesDepartamentos)) : ?>
        <tr>
            <td><?php echo $dados[0]; ?></td>
            <td><?php echo $dados[2]; ?></td>
            <td><?php echo $dados[1]; ?></td>
            <td><?php echo $dados[3]; ?></td>



            <td>

                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalMostrarDetalhesDepartamento" onclick="recuperarDadosDepartamentoDetalhados('<?php echo $dados[0]; ?>')">
                    Detalhes
                </button>

           

                <?php
                    
                if (($_SESSION['idRoleUser'] == 1)) { ?>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditarChefeDepartamento" onclick="recuperarDadosEdicaoChefiaDepartamento('<?php echo $dados[0]; ?>')">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmacaoExclusaoChefiaDepartamento" onclick="excluirChefiaDepartamento('<?php echo $dados[0]; ?>')">
                        <i class="fas fa-trash"></i>
                    </button>
                <?php } ?>
            </td>

        </tr>

    <?php endwhile; ?>

</table>