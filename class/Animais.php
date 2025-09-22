<?php

class Animais
{

    private $conn;

    public function __construct()
    {
        $dsn = 'mysql:dbname=db_aula05;host=127.0.0.1';
        $usuario = 'root';
        $senha = '';

        $this->conn = new PDO($dsn, $usuario, $senha);
    }

    public function consultarAnimais()
    {
        $script = 'SELECT * FROM tb_animais';

        $resultado = $this->conn->query($script)->fetchAll();

        return $resultado;
    }

    public function consultarAnimaisById($id)
    {
        $script = "SELECT * FROM tb_animais WHERE id = {$id}";

        $resultado = $this->conn->query($script)->fetchAll();

        return $resultado;
    }

    public function cadastroAnimais($nome, $nome_arquivo, $tipo, $caminho_arquivo)
    {
        $script = "INSERT INTO tb_animais(nome_animal, nome_arquivo_original, tipo_arquivo, caminho_arquivo) VALUES (:nome_animal, :nome_arquivo, :tipo_arquivo, :caminho_arquivo)";

        $insert = $this->conn->prepare($script);
        
        $insert->execute([
            ":nome_animal" => $nome,    
            ":nome_arquivo"    => $nome_arquivo,
            ":tipo_arquivo"    => $tipo,
            ":caminho_arquivo" => $caminho_arquivo
        ]);

        return $this->conn->lastInsertId();
    }
}
