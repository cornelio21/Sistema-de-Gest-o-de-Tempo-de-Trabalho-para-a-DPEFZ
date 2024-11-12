<?php
ini_set('display_errors', 1);
require_once "../../classes/conexao.php";
require_once "../../classes/departamentos.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idDepartamento = $_POST['txtNomeDepartamento'];
$idFuncionario = $_POST['txtNomeChefe'];

// INSTÂNCIA DA CLASSE DE DEPARTAMENTOS
$obj = new Departamentos();

$dados= array(
    $idDepartamento,
    $idFuncionario
);

echo $obj->adicionarChefeDepartamento($dados);
