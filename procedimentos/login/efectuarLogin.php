<?php
session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";

// INSTÂNCIA DA CLASSE DE USUARIOS
$obj = new Usuarios();

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$email = $_POST['username'];
$senha = $_POST['password'];

$dados = array($email, $senha);

echo $obj->efectuarLogin($dados);