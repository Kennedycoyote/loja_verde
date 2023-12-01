<?php

use Application\core\Controller;
use Application\dao\ProdutoDAO;
use Application\models\Produto;

class ProdutoController extends Controller
{
    // INDEX
    public function index()
    {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /usuario/login");
            exit();
        }
        $produtoDAO = new ProdutoDAO();
        $produtos = $produtoDAO->findAll();
        $this->view('produto/index', ['produtos' => $produtos]);
    }

    // CADASTRAR
    public function cadastrar()
    {
        $this->view('produto/cadastrar');
    }

    // SALVAR
    public function salvar()
    {
        $nome = $_POST['nome_produto'];
        $marca = $_POST['marca'];
        $preco = $_POST['preco'];
        $imagemUrl = isset($_POST['imagem_url']) ? $_POST['imagem_url'] : null;

        if (!empty($_FILES['imagem']['name'])) {
            $imagemUrl = $this->salvarImagem($_FILES['imagem']);
        }

        $produto = new Produto($nome, $marca, $preco, $imagemUrl);
        $produto->setImagemUrl($imagemUrl);

        $produtoDAO = new ProdutoDAO();
        $produtoDAO->cadastrar($produto);

        $this->view('produto/cadastrar', ["msg" => "Cadastrado com Sucesso"]);
    }


    // ATUALIZAR
    public function atualizar($codigo)
    {
        $produtoDAO = new ProdutoDAO();
        $produto = $produtoDAO->findById($codigo);

        if ($produto) {
            if (isset($_POST['nome'], $_POST['marca'], $_POST['preco'])) {
                $nome = $_POST['nome'];
                $marca = $_POST['marca'];
                $preco = $_POST['preco'];


                $produto->setNome($nome);
                $produto->setMarca($marca);
                $produto->setPreco($preco);

                if (!empty($_FILES['imagem']['name'])) {
                    $imagemUrl = $this->salvarImagem($_FILES['imagem']);
                    $produto->setImagemUrl($imagemUrl);
                }

                $produtoDAO->atualizar($produto);
                header("Location: /produto/index");
                exit();
            }
        } else {
            echo "Produto não encontrado";
        }
        $this->view('produto/editar', ["produto" => $produto, "msg" => "Erro ao atualizar o produto"]);
    }

    // EXCLUIR
    public function excluir($codigo)
    {
        $produtoDAO = new ProdutoDAO();
        $produtoDAO->apagar($codigo);

        header("Location: /produto/index");
        exit();
    }

    // IMAGEM
    private function salvarImagem($imagem)
    {
        $diretorioDestino = "assets/img/";
        $diretorioDestino = str_replace('\\', '/', $diretorioDestino);
        $nomeArquivo = $imagem['name'];
        $caminhoCompleto = $diretorioDestino . $nomeArquivo;

        if (move_uploaded_file($imagem['tmp_name'], $caminhoCompleto)) {
            return '../' . $diretorioDestino . $nomeArquivo;
        } else {
            return false;
        }
    }

    // PESQUISA
    public function pesquisarProduto()
    {
        $nome = filter_input(INPUT_POST, "nome");

        $produtoDAO = new ProdutoDAO();
        $produtos = $produtoDAO->buscarPorNome($nome);

        $this->view('produto/index', ['produtos' => $produtos]);
    }
}
?>