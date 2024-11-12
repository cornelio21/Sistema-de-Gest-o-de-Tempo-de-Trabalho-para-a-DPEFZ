<?php
ini_set('display_errors', 1);
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";

// INSTÂNCIA Da CLASSE DE FUNCIONARIOS
$obj = new Funcionarios();

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$nomeFuncionario = $_POST['txtNomeFuncionario'];
$dataNascimentoFormulario = $_POST['txtDate'];
$nuit = $_POST['txtNUIT'];
$bi = $_POST['txtBI'];
$departamento = $_POST['txtDepartamento'];
$escalao = $_POST['txtEscalao'];
$classe = $_POST['txtClasse'];
$cargo = $_POST['txtCargo'];
$dataInicioCarreiraFormulario = $_POST['txtDataInicioCarreira'];
$dataRegisto = date("Y-m-d");
$generoFuncionario = $_POST['txtGeneroFuncionario'];

$dataNascimento = implode("-", array_reverse(explode("/", $dataNascimentoFormulario)));
$dataInicioCarreira = implode("-", array_reverse(explode("/", $dataInicioCarreiraFormulario)));



$dados = array($departamento, $nomeFuncionario, $dataNascimento, $nuit, $bi, $escalao, $classe, $cargo, $dataInicioCarreira, $dataRegisto, $generoFuncionario);

echo $obj->adicionarFuncionario($dados);
