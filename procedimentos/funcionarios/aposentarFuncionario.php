<?php
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idFuncionario = $_POST['idFuncionarioAposentadoria'];
$respAposentadoria = $_POST['txtRespostaAposentadoria'];

// INSTÂNCIA DA CLASSE DE FUNCIONARIOS
$obj = new Funcionarios();

$dados = array(
    $idFuncionario,
    $respAposentadoria
);

echo $obj->aposentarFuncionario($dados);