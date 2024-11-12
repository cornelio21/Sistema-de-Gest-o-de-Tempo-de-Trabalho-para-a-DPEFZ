<?php
require_once "../../classes/conexao.php";
require_once "../../classes/departamentos.php";

// INSTÂNCIA Da CLASSE DE DEPARTAMENTOS
$obj = new Departamentos();


// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idChefiaDepartamento = $_POST['txtIdChefiaDepartamento'];
$idFuncionarioChefiaActual = $_POST['txtFuncionarioChefia'];

$dados = array(
    $idChefiaDepartamento,
    $idFuncionarioChefiaActual
);


echo $obj->editarChefiaDepartamento($dados);
