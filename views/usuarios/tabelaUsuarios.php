<?php
require_once "../../classes/conexao.php";

$con = new Conexao();
$conexao = $con->conectar();

$sqlPesquisarUsuarios = "SELECT u.idUsuario, f.nomeFuncionario, u.email, u.senha, r.tipoROLE_USER, u.dataRegistoUsuario from usuarios as u join funcionarios as f on u.idFuncionario = f.idFuncionario join ROLE_USERS as r on u.idRole_users = r.idROLE_USER";
$resultPesquisarUsuarios = mysqli_query($conexao, $sqlPesquisarUsuarios);

?>
<table class="table table-bordered table-sm">

    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome do funcionário</th>
            <th scope="col">E-mail/Correio electrónico</th>
            <th scope="col">Senha</th>
            <th scope="col">Tipo usuário</th>
            <th scope="col">Data de registo</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>


    <?php while ($dados = mysqli_fetch_row($resultPesquisarUsuarios)) : ?>

        <tr>
            <td><?php echo $dados[0]; ?></td>
            <td><?php echo $dados[1]; ?></td>
            <td><?php echo $dados[2]; ?></td>
            <td><?php echo "******"; ?></td>
            <td><?php echo $dados[4]; ?></td>
            <td><?php echo $dados[5]; ?></td>
            <td>
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalMostrarDetalhesUsuario" onclick="recuperarDadosDetalhadosUsuario('<?php  echo $dados[0]; ?>')">
                    Detalhes
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdicaoUsuario" onclick="recuperarDadosUsuario('<?php  echo $dados[0]; ?>')" ><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmacaoExclusaoUsuario" onclick="excluirUsuario('<?php echo $dados[0]; ?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>

    <?php endwhile; ?>


</table>