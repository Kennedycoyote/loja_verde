<?php

use Application\core\Controller;
use Application\dao\ProdutoDAO;

class HomeController extends Controller
{
    public function index()
    {
        $produtoDAO = new ProdutoDAO();
        $produtos = $produtoDAO->findAll();

        $this->view('home/index', ['produtos' => $produtos]);
    }
}
?>