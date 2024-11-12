<?php
require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idUsuario = $_POST['txtIdUsuario'];
$userRole = $_POST['txtTipoUsuario']; 

$con = new Conexao();
$conexao = $con->conectar();

// INSTÂNCIA DA CLASSE DE USUARIOS
$obj = new Usuarios();

$dados = array(
    $idUsuario,
    $userRole
);

echo $obj->editarUsuario($dados);

