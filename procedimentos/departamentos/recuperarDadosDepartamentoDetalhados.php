<?php 
require_once "../../classes/conexao.php";
require_once "../../classes/departamentos.php";

// INSTÂNCIA Da CLASSE DE DEPARTAMENTOS
$obj = new Departamentos();

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idDepartamento = $_POST['idDepartamento'];

echo json_encode($obj->recuperarDadosDepartamentoDetalhados($idDepartamento));