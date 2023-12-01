<?php

namespace Application\dao;

use Application\models\Produto;

class ProdutoDAO
{
    private $conexao;
    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    // CRIAR 
    public function cadastrar($produto)
    {
        $conn = $this->conexao->getConexao();

        $nome = $produto->getNome();
        $marca = $produto->getMarca();
        $preco = $produto->getPreco();
        $imagemUrl = $produto->getImagemUrl();

        if (!is_numeric($preco)) {
            return false;
        }

        $SQL = "INSERT INTO produtos(codigo, nome, marca, preco, imagem_url) 
        VALUES (null, '$nome', '$marca', '$preco', '$imagemUrl')";

        if ($conn->query($SQL) === TRUE) {
            return true;
        } else {
            echo "Error: " . $SQL . "<br />" . $conn->error;
            return false;
        }
    }

    // ENCONTRAR TUDO
    public function findAll()
    {
        $conn = $this->conexao->getConexao();

        $SQL = "SELECT * FROM produtos";
        $result = $conn->query($SQL);

        $produtos = [];

        while ($row = $result->fetch_assoc()) {
            $produto = new Produto(
                isset($row["nome"]) ? $row["nome"] : null,
                isset($row["marca"]) ? $row["marca"] : null,
                isset($row["preco"]) ? $row["preco"] : null,
                isset($row["imagem_url"]) ? $row["imagem_url"] : null
            );
            $produto->setCodigo(isset($row["codigo"]) ? $row["codigo"] : null);
            array_push($produtos, $produto);
        }
        return $produtos;
    }

    // RECUPERAR
    public function findById($id)
    {
        $conn = $this->conexao->getConexao();

        $SQL = "SELECT * FROM produtos WHERE codigo = " . $id;

        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();

        if ($row) {
            $produto = new Produto(
                $row["nome"] ?? null,
                $row["marca"] ?? null,
                $row["preco"] ?? null,
                $row["imagem_url"] ?? null
            );
            $produto->setCodigo($row["codigo"]);
            return $produto;
        }
        return null;
    }

    // ATUALIZA
    public function atualizar($produto)
    {
        $conn = $this->conexao->getConexao();

        $codigo = $produto->getCodigo();
        $nome = $conn->real_escape_string($produto->getNome());
        $marca = $conn->real_escape_string($produto->getMarca());
        $preco = $conn->real_escape_string($produto->getPreco());
        $imagemUrl = $conn->real_escape_string($produto->getImagemUrl());

        $SQL = "UPDATE produtos 
                SET nome = '$nome', marca = '$marca', preco = '$preco', imagem_url = '$imagemUrl'
                WHERE codigo = $codigo";

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

        $SQL = "DELETE FROM produtos WHERE codigo = " . $id;
        if ($conn->query($SQL) === TRUE) {
            return true;
        } else {
            echo "Error: " . $SQL . "<br />" . $conn->error;
            return false;
        }
    }

    // PESQUISA 
    public function pesquisarPorNome($termoPesquisa)
    {
        $conn = $this->conexao->getConexao();
        $SQL = "SELECT * FROM produtos WHERE nome LIKE '$termoPesquisa%'";
        $result = $conn->query($SQL);
        $produtos = [];

        while ($row = $result->fetch_assoc()) {
            $produto = new Produto(
                isset($row["nome"]) ? $row["nome"] : null,
                isset($row["marca"]) ? $row["marca"] : null,
                isset($row["preco"]) ? $row["preco"] : null,
                isset($row["imagem_url"]) ? $row["imagem_url"] : null
            );
            $produto->setCodigo(isset($row["codigo"]) ? $row["codigo"] : null);
            array_push($produtos, $produto);
        }

        return $produtos;
    }
}
?>