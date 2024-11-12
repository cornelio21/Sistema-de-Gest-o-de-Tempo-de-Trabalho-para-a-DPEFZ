<?php
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";

$con = new Conexao();
$conexao = $con->conectar();

// INSTÂNCIA DA CLASSE DE FUNCIONARIOS
$obj = new Funcionarios();

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idFuncionario = $_POST['idFuncionario'];

echo json_encode($obj->recuperarDadosFuncionario($idFuncionario));






