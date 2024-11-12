<?php
require_once "../../classes/conexao.php";
require_once "../../classes/departamentos.php";


// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idChefiaDepartamento = $_POST['idChefiaDepartamento'];

// INSTÂNCIA Da CLASSE DE DEPARTAMENTOS
$obj = new Departamentos();

echo $obj->excluirChefeDepartamento($idChefiaDepartamento);