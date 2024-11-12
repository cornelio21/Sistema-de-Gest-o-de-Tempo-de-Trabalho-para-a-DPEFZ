<?php

class Conexao {

    // VARIÁVEIS PRIVADAS PARA ACEDER A BD
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "123456";
    private $bd = "sistema_sigetes";


    // FUNÇÃO QUE ESTABELECE CONEXÃO COM A BD
    public function conectar() {
        $conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->bd);
        mysqli_set_charset($conexao, "utf8mb4");
        // if (!$conexao) {
        //     echo "Falha conexao";
        // } else {
        //     echo "Conectado";
        // };

        return $conexao;
    }
}
