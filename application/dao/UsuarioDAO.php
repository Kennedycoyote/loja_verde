<?php

namespace Application\dao;

use Application\models\Usuario;

class UsuarioDAO
{
    private $conexao;
    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    // CRIAR
    public function cadastrar($usuario)
    {
        $conn = $this->conexao->getConexao();
        $nome = $conn->real_escape_string($usuario->getNome());
        $email = $conn->real_escape_string($usuario->getEmail());
        $senha = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);


        $SQL = "INSERT INTO usuarios(nome, email, senha) 
                VALUES ('$nome', '$email', '$senha')";

        try {
            if ($conn->query($SQL) === TRUE) {
                return true;
            } else {
                throw new \Exception("Erro ao cadastrar usuário: " . $conn->error);
            }
        } catch (\Exception $e) {

            return false;
        }
    }


    // ENCONTRAR TUDO
    public function findAll()
    {
        $conn = $this->conexao->getConexao();

        $SQL = "SELECT * FROM usuarios";
        $result = $conn->query($SQL);

        $usuarios = [];

        while ($row = $result->fetch_assoc()) {
            $usuario = new Usuario(
                isset($row["nome"]) ? $row["nome"] : null,
                isset($row["email"]) ? $row["email"] : null,
                isset($row["senha"]) ? $row["senha"] : null
            );

            $usuario->setId(isset($row["id"]) ? $row["id"] : null);
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    // RECUPERAR
    public function findById($id)
    {
        $conn = $this->conexao->getConexao();

        $SQL = "SELECT * FROM usuarios WHERE id = " . $id;

        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();

        if ($row) {
            $usuario = new Usuario(
                $row["nome"] ?? null,
                $row["email"] ?? null,
                $row["senha"] ?? null

            );
            $usuario->setId($row["id"]);
            return $usuario;
        }
        return null;
    }

    // ATUALIZA
    public function atualizar($usuario)
    {
        $conn = $this->conexao->getConexao();

        $id = $usuario->getId();
        $nome = $conn->real_escape_string($usuario->getNome());
        $email = $conn->real_escape_string($usuario->getEmail());
        $senha = $conn->real_escape_string($usuario->getSenha());


        $SQL = "UPDATE usuarios 
                SET nome = '$nome', email = '$email', senha = '$senha'
                WHERE id = $id";

        if ($conn->query($SQL) === TRUE) {
            return true;
        } else {
            echo "Error: " . $SQL . "<br />" . $conn->error;
            return false;
        }
    }

    // DELETA
    public function apagar($id)
    {
        $conn = $this->conexao->getConexao();

        $SQL = "DELETE FROM usuarios WHERE id = " . $id;
        if ($conn->query($SQL) === TRUE) {
            return true;
        } else {
            echo "Error: " . $SQL . "<br />" . $conn->error;
            return false;
        }
    }

    // PESQUISA
    public function buscarPorNome($nome)
    {
        $conn = $this->conexao->getConexao();
        $SQL = "SELECT * FROM usuarios WHERE nome LIKE '$nome%'";
        $result = $conn->query($SQL);
        $usuarios = [];

        while ($row = $result->fetch_assoc()) {
            $usuario = new Usuario(
                $row['nome'] ?? null,
                $row['email'] ?? null,
                $row['senha'] ?? null,

            );
            $usuario->setId($row['id'] ?? null);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }
}
?>