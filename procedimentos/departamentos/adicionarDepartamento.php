<?php
require_once "../../classes/conexao.php";
require_once "../../classes/departamentos.php";

// INSTÂNCIAS DE CLASSES DE CONEXAO E DEPARTAMENTOS
$obj= new Departamentos();


// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$nomeDepartamento = $_POST['txtDepartamento'];

$dados = [$nomeDepartamento];

echo $obj->adicionarDepartamento($dados);





