<?php
ini_set('display_errors', 1);
require_once "../../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sqlPesquisaFuncionariosAposentados = "SELECT p.idFuncionario_aposentado, f.nomeFuncionario, YEAR(f.dataInicioCarreira), YEAR(p.dataAposentadoria), f.dataInicioCarreira, p.dataAposentadoria FROM funcionarios_aposentados as p INNER JOIN funcionarios as f on p.idFuncionario = f.idFuncionario";
$resultPesquisaFuncionariosAposentados = mysqli_query($conexao, $sqlPesquisaFuncionariosAposentados);

?>
<div class="table-responsive">
    <table class="table table-sm table-bordered border-primary">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome do funcionário</th>
                <th>Anos de carreira</th>
                <th>Data inicio carreira</th>
                <th>Data de aposentação</th>
                
            </tr>
        </thead>

        <tbody>
            <?php
            while ($dadosPesquisaFuncionariosAposentados = mysqli_fetch_row($resultPesquisaFuncionariosAposentados)) : ?>
                <tr>
                    <td><?php echo $dadosPesquisaFuncionariosAposentados[0]; ?></td>
                    <td><?php echo $dadosPesquisaFuncionariosAposentados[1]; ?></td>
                    <td><?php echo ($dadosPesquisaFuncionariosAposentados[3] - $dadosPesquisaFuncionariosAposentados[2]); ?></td>
                    <td><?php echo $dadosPesquisaFuncionariosAposentados[4]; ?></td>
                    <td><?php echo $dadosPesquisaFuncionariosAposentados[5]; ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>