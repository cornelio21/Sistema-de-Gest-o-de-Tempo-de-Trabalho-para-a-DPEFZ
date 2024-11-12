<?php

require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idusuario = $_POST['idUsuario'];

$con = new Conexao();
$conectar = $con->conectar();

// INSTÂNCIA DA CLASSE DE USUARIOS
$obj = new Usuarios();

echo json_encode($obj->recuperarDadosDetalhadosUsuario($idusuario));