<?php
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idFuncionario = $_POST['txtIdFuncionarioEdicao'];
$nomeFuncionario = $_POST['txtNomeFuncionarioEdicao'];
$dataNascimento = $_POST['txtDataNascimentoEdicao'];
$numeroBI = $_POST['txtBIEdicao'];
$numeroNUIT = $_POST['txtNUITEdicao'];
$idDepartamento = $_POST['txtDepartamentoEdicao'];
$cargo = $_POST['txtCargoEdicao'];




$con = new Conexao();
$conexao = $con->conectar();

// INSTÂNCIA DA CLASSE DE FUNCIONARIOS
$obj = new Funcionarios();

$dados = array(
    $idFuncionario,
    $nomeFuncionario,
    $dataNascimento,
    $numeroBI,
    $numeroNUIT,
    $idDepartamento,
    $cargo
);

echo $obj->editarFuncionario($dados);



