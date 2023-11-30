<?php
namespace Application\models;

class Produto
{
    private $codigo;
    private $nome;
    private $marca;
    private $preco;
    private $imagemUrl;

    public function __construct($nome, $marca, $preco, $imagemUrl = null)
    {
        $this->nome = $nome;
        $this->marca = $marca;
        $this->preco = $preco;
        $this->imagemUrl = $imagemUrl;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function setImagemUrl($imagemUrl)
    {
        $this->imagemUrl = $imagemUrl;
    }

    public function getImagemUrl()
    {
        return $this->imagemUrl;
    }
}
?>