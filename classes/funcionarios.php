<?php

class Funcionarios
{

    // FUNCAO PARA INSERÇÃO DE DADOS DOS FUNCIONARIO
    public function adicionarFuncionario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "INSERT INTO funcionarios (idFuncionario, idDepartamento, nomeFuncionario, dataNascimento, numeroNUIT, numeroBI, escalaoFuncionario, classeFuncionario, cargo, dataInicioCarreira, isAposentado, isUserSystem, dataRegisto, generoFuncionario) values (default, '$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]', '$dados[6]', '$dados[7]', '$dados[8]', default, default, '$dados[9]', '$dados[10]')";

        return mysqli_query($conexao, $sql);
    }

    // FUNCAO PARA EXCLUSAO DE DADOS DO FUNCIONARIO
    public function excluirFuncionario($idFuncionario)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "DELETE FROM funcionarios WHERE idFuncionario = '$idFuncionario'";
        echo mysqli_query($conexao, $sql);
    }

    // FUNCAO PARA RECUPERAR DADOS DE USUARIO 
    public function recuperarDadosFuncionario($idFuncionario)
    {
        $con = new Conexao();
        $conexao = $con->conectar();


        $sql = "SELECT f.idFuncionario, d.idDepartamento, f.nomeFuncionario, f.dataNascimento, f.numeroNUIT, f.numeroBI, f.escalaoFuncionario, f.classeFuncionario, f.cargo, f.dataInicioCarreira, f.dataRegisto, d.nomeDepartamento, YEAR(f.dataNascimento), YEAR(f.dataInicioCarreira), f.generoFuncionario from funcionarios as f join departamentos as d on f.idDepartamento = d.idDepartamento where f.idFuncionario = '$idFuncionario'";
        $resultado =  mysqli_query($conexao, $sql);
        $resultadoItem = mysqli_fetch_row($resultado);

        $dados = array(
            "idFuncionario" => $resultadoItem[0],
            "idDepartamento" => $resultadoItem[1],
            "nomeFuncionario" =>  $resultadoItem[2],
            "dataNascimento" => $resultadoItem[3],
            "numeroNUIT" => $resultadoItem[4],
            "numeroBI" => $resultadoItem[5],
            "escalao" => $resultadoItem[6],
            "classe" => $resultadoItem[7],
            "cargo" => $resultadoItem[8],
            "dataInicioCarreira" => $resultadoItem[9],
            "dataRegisto" => $resultadoItem[10],
            "nomeDepartamento" => $resultadoItem[11],
            "idadeFuncionario" => (date('Y') - $resultadoItem[12]),
            "anosServico" => (date('Y') - $resultadoItem[13]),
            "generoFuncionario" => $resultadoItem[14]
        );

        return $dados;
    }

    // FUNCAO PARA RECUPERAR DADOS DETALHADOS PARA CONSULTA 
    public function recuperarDadosDetalhadosFuncionario($idFuncionario)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT f.idFuncionario, f.nomeFuncionario, f.dataNascimento, YEAR(f.dataNascimento), f.numeroNUIT, f.numeroBI, f.escalaoFuncionario, f.classeFuncionario, f.cargo, f.dataInicioCarreira, YEAR(f.dataInicioCarreira), f.isAposentado, f.isUserSystem, f.dataRegisto, d.nomeDepartamento, f.generoFuncionario from funcionarios as f inner join departamentos as d on f.idDepartamento = d.idDepartamento WHERE f.idFuncionario = '$idFuncionario'";
        $resultado = mysqli_query($conexao, $sql);
        $resultadoItem = mysqli_fetch_row($resultado);


        $dados = array(
            "idFuncionario" => $resultadoItem[0],
            "nomeFuncionario" =>  $resultadoItem[1],
            "dataNascimento" => $resultadoItem[2],
            "idadeFuncionario" => (date('Y') - $resultadoItem[3]),
            "numeroNUIT" => $resultadoItem[4],
            "numeroBI" => $resultadoItem[5],
            "escalao" => $resultadoItem[6],
            "classe" => $resultadoItem[7],
            "cargo" => $resultadoItem[8],
            "dataInicioCarreira" => $resultadoItem[9],
            "anosServico" => (date('Y') - $resultadoItem[10]),
            "isAposentado" => $resultadoItem[11],
            "isUserSystem" => $resultadoItem[12],
            "dataRegisto" => $resultadoItem[13],
            "nomeDepartamento" => $resultadoItem[14],
            "generoFuncionario" => $resultadoItem[15]
        );

        return $dados;
    }

    // FUNCAO PARA EDITAR DADOS DE FUNCIONARIO
    public function editarFuncionario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "UPDATE funcionarios set idDepartamento = '$dados[5]', nomeFuncionario = '$dados[1]', dataNascimento = '$dados[2]', numeroNUIT = '$dados[4]', numeroBI = '$dados[3]', cargo = '$dados[6]' where idFuncionario = '$dados[0]'";

        return mysqli_query($conexao, $sql);
    }

    // FUNCAO PARA PROMOVER DADOS DE FUNCIONARIO
    public function promoverFuncionario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "UPDATE funcionarios set classeFuncionario = '$dados[1]' where idFuncionario = '$dados[0]'";


        return mysqli_query($conexao, $sql);
    }

    // FUNCAO PARA PROGREDIR FUNCIONARIO
    public function progredirFuncionario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "UPDATE funcionarios set escalaoFuncionario = '$dados[1]' where idFuncionario = '$dados[0]'";


        return mysqli_query($conexao, $sql);
    }

    // FUNCAO PARA APOSENTAR FUNCIONARIO
    public function aposentarFuncionario($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "UPDATE funcionarios set isAposentado = '$dados[1]' WHERE idFuncionario = '$dados[0]'";

        return mysqli_query($conexao, $sql);
    }

 
}
