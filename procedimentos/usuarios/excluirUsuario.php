<?php
require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";

$con = new Conexao();
$conexao = $con -> conectar();

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idUsuario = $_POST['idUsuario'];

// INSTÂNCIA DA CLASSE DE USUARIOS
$obj = new Usuarios();


echo $obj->excluirUsuario($idUsuario);
