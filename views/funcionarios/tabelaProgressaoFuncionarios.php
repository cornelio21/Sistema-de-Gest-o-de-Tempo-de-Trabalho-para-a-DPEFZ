<?php
ini_set('display_errors', 1);
require_once "../../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sqlPesquisaProgressaoFuncionarios = "SELECT p.idFuncionario_progressao, f.nomeFuncionario, f.cargo, p.escalao_antigo, p.escalao_actual, p.dataRegisto_progressao FROM funcionarios_progressao_carreiras as p INNER JOIN funcionarios as f on p.idFuncionario = f.idFuncionario ORDER BY p.dataRegisto_progressao desc";
$resultPesquisaProgressaoFuncionarios = mysqli_query($conexao, $sqlPesquisaProgressaoFuncionarios);


?>
<div class="table-responsive">
    <table class="table table-sm table-bordered border-primary">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome do funcionário</th>
                <th>Cargo</th>
                <th>Escalão antigo</th>
                <th>Escalão actual</th>
                <th>Data da progressão</th>
                
            </tr>
        </thead>

        <tbody>
            <?php
            if ($dadosPesquisaProgressaoFuncionario = mysqli_fetch_row($resultPesquisaProgressaoFuncionarios)) {
                while ($dadosPesquisaProgressaoFuncionario = mysqli_fetch_row($resultPesquisaProgressaoFuncionarios)) : ?>
                    <tr>
                        <td><?php echo $dadosPesquisaProgressaoFuncionario[0]; ?></td>
                        <td><?php echo $dadosPesquisaProgressaoFuncionario[1]; ?></td>
                        <td><?php echo $dadosPesquisaProgressaoFuncionario[2]; ?></td>
                        <td><?php echo $dadosPesquisaProgressaoFuncionario[3]; ?></td>
                        <td><?php echo $dadosPesquisaProgressaoFuncionario[4]; ?></td>
                        <td><?php echo $dadosPesquisaProgressaoFuncionario[5]; ?></td>
                        
                    </tr>
            <?php endwhile;
            } else {
                echo "<caption>Sem registos</caption>";
            }
            ?>
        </tbody>
    </table>
</div>