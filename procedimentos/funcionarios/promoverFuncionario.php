<?php
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idFuncionario = $_POST['idFuncionarioPromocao'];
$classeFuncionario = $_POST['txtClasseActualizacao'];

// INSTÂNCIA DA CLASSE DE FUNCIONARIOS
$obj = new Funcionarios();

$dados = array(
    $idFuncionario,
    $classeFuncionario
);


echo $obj->promoverFuncionario($dados);