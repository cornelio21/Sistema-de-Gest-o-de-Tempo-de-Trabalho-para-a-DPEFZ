<?php
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idFuncionario = $_POST['idFuncionarioProgressao'];
$escalaoFuncionario = $_POST['txtEscalaoActualizacao'];

// INSTÂNCIA DA CLASSE DE FUNCIONARIOS
$obj = new Funcionarios();

$dados = array(
    $idFuncionario,
    $escalaoFuncionario
);

echo $obj->progredirFuncionario($dados);
