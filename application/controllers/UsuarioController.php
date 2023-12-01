<?php

use Application\core\Controller;
use Application\dao\UsuarioDAO;
use Application\models\Usuario;

class UsuarioController extends Controller
{
    // INDEX
    public function index()
    {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /usuario/login");
            exit();
        }
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->findAll();
        $this->view('usuario/index', ['usuarios' => $usuarios]);
    }

    // CADASTRAR
    public function cadastrar()
    {
        $this->view('usuario/cadastrar');
    }

    // SALVAR
    public function salvar()
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];


        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario($nome, $email, $senha);

        if ($usuarioDAO->cadastrar($usuario)) {
            $this->view('usuario/cadastrar', ['msg' => 'Cadastro realizado com sucesso.']);
        } else {
            $this->view('usuario/cadastrar', ['msg' => 'Erro ao cadastrar usuário.']);
        }
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->findById($id);

        if ($usuario) {
            if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];


                $usuario->setNome($nome);
                $usuario->setEmail($email);
                $usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));


                $usuarioDAO->atualizar($usuario);
                header("Location: /usuario/index");
                exit();
            }
        } else {
            echo "Usuário não encontrado";
        }
        $this->view('usuario/editar', ["usuario" => $usuario, "msg" => "Erro ao atualizar o usuário"]);
    }

    //EXCLUIR
    public function excluir($codigo)
    {
        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->apagar($codigo);

        header("Location: /usuario/index");
        exit();
    }

    // LOGIN
    public function login()
    {
        $nome = $_POST['nome']??'';
        $senha = $_POST['senha']??'';

        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->buscarPorNome($nome);

        if (!empty($usuarios)) {
            $usuario = $usuarios[0];
            if (password_verify($senha, $usuario->getSenha())) {

                $_SESSION['usuario'] = $usuario;
                $this->view('produto/index', ['msg' => 'Login realizado com sucesso.']);
            } else {
                $this->view('usuario/login', ['msg' => 'Nome ou senha incorretos.']);
            }
        } else {
            $this->view('usuario/login', ['msg' => 'Nome ou senha incorretos.']);
        }
    }

    // LOGOUT
    public function logout()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header("Location: ../home/index");
        exit();
    }
}

    // PESQUISA
    
?>