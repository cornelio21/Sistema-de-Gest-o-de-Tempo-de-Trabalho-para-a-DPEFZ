<?php
require_once "../../classes/conexao.php";
require_once "../../classes/departamentos.php";

// INSTÂNCIA Da CLASSE DE DEPARTAMENTOS
$obj = new Departamentos();


// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idDepartamento = $_POST['txtIdDepartamentoEdicao'];
$nomeDepartamento = $_POST['txtNomeDepartamentoEdicao'];

$dados = array(
    $idDepartamento,
    $nomeDepartamento
);

echo $obj->editarDepartamento($dados);