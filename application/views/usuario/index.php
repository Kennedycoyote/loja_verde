<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página de Usuários</title>

</head>

<body class="container mt-4">

    <h1 class="display-4">Lista de Usuários</h1>
    <hr class="my-4">

    <form action="/usuario/pesquisarUsuario" method="POST" class="form-inline">
        <div class="form-group">
            <input type="text" name="nome" placeholder="Pesquisar por nome" class="form-control mr-2">
        </div>
        <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
    </form>

    <p> <a href="/usuario/cadastrar" class="btn btn-primary">Adicionar Usuário</a></p>


    <?php if (isset($data['usuarios']) && is_array($data['usuarios'])) { ?>
        <table class="table table-striped table-bordered">

            <thead class="thead-dark">
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </thead>

            <tbody>
                <?php foreach ($data['usuarios'] as $usuario) { ?>
                    <tr>
                        <td>
                            <?= $usuario->getId() ?>
                        </td>
                        <td>
                            <?= $usuario->getNome() ?>
                        </td>
                        <td>
                            <?= $usuario->getEmail() ?>
                        </td>
                        <td>
                            <a href="/usuario/atualizar/<?= $usuario->getId() ?>" class="btn btn-primary">Editar</a>
                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirmacaoExclusao<?= $usuario->getId() ?>">Excluir</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="confirmacaoExclusao<?= $usuario->getId() ?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de que deseja excluir o usuário "
                                    <?= $usuario->getNome() ?>"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                    <a href="/usuario/excluir/<?= $usuario->getId() ?>" class="btn btn-danger">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p> Não há usuários cadastrados</p>
    <?php } ?>
</body>

</html>