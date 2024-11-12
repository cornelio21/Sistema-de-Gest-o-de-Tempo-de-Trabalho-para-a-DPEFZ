<?php
ini_set('display_errors', 1);
require_once "../../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sqlPesquisaPromocaoFuncionarios = "SELECT p.idFuncionario_promovido, f.nomeFuncionario, f.cargo, p.classe_antiga, p.classe_actual, p.dataRegisto_promocao FROM funcionarios_promocao_carreiras as p INNER JOIN funcionarios as f on p.idFuncionario = f.idFuncionario order by p.dataRegisto_promocao desc";
$resultPesquisaPromocaoFuncionarios = mysqli_query($conexao, $sqlPesquisaPromocaoFuncionarios);

?>

<div class="table-responsive">
    <table class="table table-sm table-bordered border-primary">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome do funcionário</th>
                <th>Cargo</th>
                <th>Classe antigo</th>
                <th>Classe actual</th>
                <th>Data da promoção</th>
                
            </tr>
        </thead>

        <tbody>
            <?php if ($dadosPesquisaPromocaoFuncionarios = mysqli_fetch_row($resultPesquisaPromocaoFuncionarios)) {
                while ($dadosPesquisaPromocaoFuncionarios = mysqli_fetch_row($resultPesquisaPromocaoFuncionarios)) : ?>
                    <tr>
                        <td><?php echo $dadosPesquisaPromocaoFuncionarios[0]; ?></td>
                        <td><?php echo $dadosPesquisaPromocaoFuncionarios[1];  ?></td>
                        <td><?php echo $dadosPesquisaPromocaoFuncionarios[2];  ?></td>
                        <td><?php echo $dadosPesquisaPromocaoFuncionarios[3];  ?></td>
                        <td><?php echo $dadosPesquisaPromocaoFuncionarios[4];  ?></td>
                        <td><?php echo $dadosPesquisaPromocaoFuncionarios[5];  ?></td>
                      
                    </tr>
            <?php endwhile;
            } else {
                echo "<caption>Sem registos</caption>";
            }

            ?>
        </tbody>
    </table>
</div>