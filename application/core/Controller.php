<?php

namespace Application\core;

class Controller
{
  public function __construct()
  {
    session_start();
    if (!$this->estaLogado() && $this->protegerRotas()) {
      header("Location: /usuario/login");
      exit();
    }
  }
  private function estaLogado()
  {
    return isset($_SESSION['usuario']);
  }
  private function protegerRotas()
  {
    $rotasProtegidas = ['/produto/cadastrar', '/produto/editar', '/produto/index'];
    return in_array($_SERVER['REQUEST_URI'], $rotasProtegidas);
  }
  public function model($model)
  {
    require '../Application/models/' . $model . '.php';
    $classe = 'Application/models\\' . $model;
    return new $classe();
  }
  public function view(string $view, $data = [])
  {
    require '../Application/views/' . $view . '.php';
  }
  public function pageNotFound()
  {
    $this->view('error404');
  }
}
?>