<?php
require_once "../../classes/conexao.php";
require_once "../../classes/departamentos.php";

// INSTÂNCIA Da CLASSE DE DEPARTAMENTOS
$obj = new Departamentos();

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idChefiaDepartamento = $_POST['idChefiaDepartamento'];

echo json_encode($obj->recuperarDadosEdicaoChefiaDepartamento($idChefiaDepartamento));