<?php
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";

// INSTÂNCIA DA CLASSE DE FUNCIONARIOS
$obj = new Funcionarios();

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idFuncionario = $_POST['idFuncionario'];

echo $obj->excluirFuncionario($idFuncionario);