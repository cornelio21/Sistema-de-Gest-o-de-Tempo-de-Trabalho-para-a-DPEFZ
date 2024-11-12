<?php

class Departamentos
{
    // FUNÇÃO PARA A INSERCAO DE NOVO DEPARTAMENTO
    public function adicionarDepartamento($dados)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "INSERT into departamentos (idDepartamento, nomeDepartamento, numeroTotalFuncionarios, dataRegisto) values (default, '$dados[0]', default, now())";
  
        return mysqli_query($conexao, $sql);
    }

    // FUNÇÃO PARA  EXCLUSAO DE REGISTO DE DEPARTAMENTO
    public function excluirDepartamento($idDepartamento)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "DELETE from departamentos where idDepartamento = '$idDepartamento'";

        echo mysqli_query($conexao, $sql);
    }

    // FUNÇÃO PARA A RECUPERACAO DE DADOS PARA EDICAO DE REGISTO DE DEPARTAMENTO
    public function recuperarDadosEdicaoDepartamento($idDepartamento)
    {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT idDepartamento, nomeDepartamento FROM departamentos where idDepartamento = '$idDepartamento'";

        $result = mysqli_query($conexao, $sql);
        $resultItem = mysqli_fetch_row($result);

        $dados = array(
            'idDepartamento' => $resultItem[0],
            'nomeDepartamento' => $resultItem[1]
        );

        return $dados;
    }

      // FUNÇÃO PARA A RECUPERACAO DE DADOS DETALHADOS DO DEPARTAMENTO
    public function recuperarDadosDepartamentoDetalhados($idDepartamento) {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT d.idDepartamento, d.nomeDepartamento, d.numeroTotalFuncionarios, d.dataRegisto, f.nomeFuncionario from departamentos as d inner join funcionarios_chefes_departamentos as c on d.idDepartamento = c.idDepartamento inner join funcionarios as f on c.idFuncionario = f.idFuncionario where d.idDepartamento = '$idDepartamento'";
        $result = mysqli_query($conexao, $sql);
        $resultItem = mysqli_fetch_row($result);

        $dados = array(
            "idDepartamento" => $resultItem[0],
            "nomeDepartamento" => $resultItem[1],
            "numeroTotalFuncionarios" => $resultItem[2],
            "dataRegistoDepartamento" => $resultItem[3],
            "nomeChefiaDepartamento" => $resultItem[4]
        );

        return $dados;
    }

    // FUNÇÃO PARA EDICAO DE REGISTO DE DEPARTAMENTO
    public function editarDepartamento($dados){
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "UPDATE departamentos set nomeDepartamento = '$dados[1]' where idDepartamento = '$dados[0]'";
        return mysqli_query($conexao, $sql);
    }

    // FUNÇÃO PARA EXCLUSAO DE REGISTO DEPARTAMENTO ASSOCIADO A UM DEPARTAMENTO
    public function adicionarChefeDepartamento($dados){
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "INSERT into funcionarios_chefes_departamentos (idFuncionarios_chefes_departamentos, idFuncionario, idDepartamento, dataRegisto) values (default, '$dados[0]', '$dados[1]', now())";
        return mysqli_query($conexao, $sql);
    }

    // FUNÇÃO PARA EXCLUSAO DE DEPARTAMENTO ASSOCIADO A UM CHEFIA
    public function excluirChefeDepartamento($idChefiaDepartamento) {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "DELETE FROM funcionarios_chefes_departamentos WHERE idFuncionarios_chefes_departamentos = '$idChefiaDepartamento'";
        
        echo mysqli_query($conexao, $sql);
    }


     // FUNÇÃO PARA RECUPERAR DADOS PARA A EDICAO DE CARGO DE CHEFIA DE DEPARTAMENTO 
    public function recuperarDadosEdicaoChefiaDepartamento($idChefiaDepartamento) {
        $con = new Conexao();
        $conexao = $con->conectar();

        $sql = "SELECT c.idFuncionarios_chefes_departamentos, f.nomeFuncionario, d.nomeDepartamento, c.dataRegisto from funcionarios_chefes_departamentos as c INNER JOIN funcionarios as f on c.idFuncionario = f.idFuncionario INNER JOIN departamentos as d on c.idDepartamento = d.idDepartamento where c.idFuncionarios_chefes_departamentos = '$idChefiaDepartamento'";
        $result = mysqli_query($conexao, $sql);
        $resultItem = mysqli_fetch_row($result);

        $dados = array(
            "idChefiaDepartamento" => $resultItem[0],
            "nomeFuncionario" => $resultItem[1],
            "nomeDepartamento" => $resultItem[2],
            "dataTomadaPosse" => $resultItem[3]
        );

        return $dados;       
    }

     // FUNÇÃO PARA EDICAO DE CARGO DE CHEFIA DE DEPARTAMENTO
     public function editarChefiaDepartamento($dados){
         $con = new Conexao();
         $conexao = $con -> conectar();

         $sql = "UPDATE funcionarios_chefes_departamentos set idFuncionario = '$dados[1]' where idFuncionarios_chefes_departamentos = '$dados[0]'";

         return mysqli_query($conexao, $sql);
     }



}
