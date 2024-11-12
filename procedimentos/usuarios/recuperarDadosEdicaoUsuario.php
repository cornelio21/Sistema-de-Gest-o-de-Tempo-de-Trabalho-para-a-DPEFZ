<?php
require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idUsuario = $_POST['idUsuario'];

$con = new Conexao();
$conexao = $con->conectar();

// INSTÂNCIA DA CLASSE DE USUARIOS
$obj = new Usuarios();

echo json_encode($obj->recuperarDadosEdicaoUsuario($idUsuario));
