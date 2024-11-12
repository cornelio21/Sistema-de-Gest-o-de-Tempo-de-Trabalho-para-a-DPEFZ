<?php

class Usuarios
{
    // FUNÇÃO PARA A INSERCAO DE NOVO USUÁRIO
    public function adicionarUsuario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "INSERT INTO usuarios (idUsuario, idRole_Users, idFuncionario, email, senha, dataRegistoUsuario) values (default, '$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', now())";

        return mysqli_query($conexao, $sql);
    }

    // FUNÇÃO PARA EFECTUAR NOVO LOGIN
    public function efectuarLogin($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $senha = sha1($dados[1]);

        $_SESSION['usuario'] = $dados[0];
        $_SESSION['id'] = self::obterIdUsuario($dados);
        $_SESSION['nomeUsuario'] = self::obterNomeUsuario($_SESSION['id']);
        $_SESSION['idRoleUser'] = self::obterIdRoleUser($_SESSION['id']);

        $sql = "SELECT * from usuarios where email = '$dados[0]' and senha = '$senha'";

        $result = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($result) > 0) {
            return 1;
        } else {
            return 0;
        };
    }

    // FUNÇÃO PARA O RETORNO DO ID DO USUÁRIO
    public function obterIdUsuario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $senha = sha1($dados[1]);

        $sql = "SELECT idUsuario FROM usuarios where email = '$dados[0]' and senha = '$senha'";
        $result = mysqli_query($conexao, $sql);

        return mysqli_fetch_row($result)[0];
    }

    // FUNÇÃO PARA OBTER O NOME DE USUÁRIO
    public function obterNomeUsuario($idUsuario)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT f.nomeFuncionario from funcionarios as f inner join usuarios as u on f.idFuncionario = u.idFuncionario where u.idUsuario = '$idUsuario'";
        $result = mysqli_query($conexao, $sql);

        return mysqli_fetch_row($result)[0];
    }

    // FUNÇÃO PARA OBTER O ID DO TIPO DE USUARIO
    public function obterIdRoleUser($idUsuario) {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT idRole_Users FROM usuarios WHERE idUsuario = '$idUsuario'";
        $result = mysqli_query($conexao, $sql);

        return mysqli_fetch_row($result)[0];
    }

    // FUNÇÃO PARA EXCLUIR USUÁRIO
    public function excluirUsuario($idUsuario)
    {
        $con = new Conexao();
        $conexao = $con->conectar();
        $sql = "DELETE from usuarios where idUsuario = '$idUsuario'";

        echo mysqli_query($conexao, $sql);
    }

    // FUNÇÃO PARA RECUPERAR DADOS DO USUARIOS PARA EDICAO
    public function recuperarDadosEdicaoUsuario($idUsuario)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT u.idUsuario, f.nomeFuncionario, u.email, r.idROLE_USER, r.tipoROLE_USER from usuarios as u inner join ROLE_USERS as r on u.idRole_Users = r.idROLE_USER INNER JOIN funcionarios as f on u.idFuncionario = f.idFuncionario where u.idUsuario = '$idUsuario'";

        $result = mysqli_query($conexao, $sql);

        $resultItem = mysqli_fetch_row($result);

        $dados = array(
            "idUsuario" => $resultItem[0],
            "nomeFuncionario" => $resultItem[1],
            "emailUsuario" => $resultItem[2],
            "idRoleUsers" => $resultItem[3],
            "tipoRole" => $resultItem[4]
        );
        return $dados;
    }

    // FUNÇÃO PARA RECUPERAR DADOS DETALHADOS DO USUÁRIO
    public function recuperarDadosDetalhadosUsuario($idUsuario)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT u.idUsuario, u.email, u.senha, u.dataRegistoUsuario, f.nomeFuncionario, f.cargo, r.tipoROLE_USER, d.nomeDepartamento FROM usuarios as u inner join funcionarios as f on u.idFuncionario = f.idFuncionario inner join ROLE_USERS as r on u.idRole_Users = r.idROLE_USER inner join departamentos as d on f.idDepartamento = d.idDepartamento where u.idUsuario = '$idUsuario'";
        $result = mysqli_query($conexao, $sql);
        $resultItem = mysqli_fetch_row($result);

        $dados = array(
            "idUsuario" => $resultItem[0],
            "emailUsuario" => $resultItem[1],
            "senha" => $resultItem[2],
            "dataRegistoUsuario" => $resultItem[3],
            "nomeUsuario" => $resultItem[4],
            "cargoUsuario" => $resultItem[5],
            "tipoUsuario" => $resultItem[6],
            "nomeDepartamento" => $resultItem[7]
        );

        return $dados;
    }

    // FUNÇÃO PARA EDITAR USUARIOS
    public function editarUsuario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "UPDATE usuarios set idRole_users = '$dados[1]' where idUsuario = '$dados[0]'";

        echo mysqli_query($conexao, $sql);
    }
}
