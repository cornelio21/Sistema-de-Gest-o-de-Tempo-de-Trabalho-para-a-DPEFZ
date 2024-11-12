<?php
ini_set('display_errors', 1);
require_once "../../classes/conexao.php";
require_once "../../classes/usuarios.php";

// INSTÂNCIA DA CLASSE DE USUARIOS
$objUsuarios = new Usuarios(); 

// VARIÁVEIS COM VALORES VINDOS DO FORMULARIO
$idRole = $_POST['txtUserRole'];
$idFuncionario = $_POST['txtFuncionarioUsuario'];
$emailFuncionario = $_POST['txtEmail'];
$senha = $_POST['txtSenha'];

// ENCRIPTAÇÃO DA SENHA
$senhaCriptografada = sha1($senha);

$dados = array(
    $idRole,
    $idFuncionario,
    $emailFuncionario,
    $senhaCriptografada
);

echo $objUsuarios->adicionarUsuario($dados);

