<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Pagina de Produtos</title>
</head>

<body class="container mt-4">

    <h1 class="display-4">Lista de Produtos</h1>
    <hr class="my-4">
    <form action="/produto/pesquisarProduto" method="POST" class="form-inline">
    <div class="form-group">
        <input type="text" name="termo_pesquisa" placeholder="Pesquisar por nome" class="form-control mr-2">
    </div>
    <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
</form>
    <p> <a href="/produto/cadastrar" class="btn btn-primary"> Adicionar Produto </a></p>
    <?php if (isset($data['produtos']) && is_array($data['produtos'])) { ?>
        <table class="table table-striped table-bordered">

            <thead class="thead-dark">
                <th>Código</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Preço</th>
                <th>Ações</th>
                <th>Imagem</th>
            </thead>

            <tbody>
                <?php foreach ($data['produtos'] as $produto) { ?>
                    <tr>
                        <td>
                            <?= $produto->getCodigo() ?>
                        </td>
                        <td>
                            <?= $produto->getNome() ?>
                        </td>
                        <td>
                            <?= $produto->getMarca() ?>
                        </td>
                        <td>
                            <?= $produto->getPreco() ?>
                        </td>

                        <td>
                            <a href="/produto/atualizar/<?= $produto->getCodigo() ?>" class="btn btn-primary">Editar</a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#confirmacaoExclusao<?= $produto->getCodigo() ?>">Excluir</a>
                        </td>
                        <td><img src="<?= $produto->getImagemUrl() ?>" alt="Imagem do Produto" style="max-width: 50px; max-height: 50px; border: 1px solid #ccc;"></td>

                    </tr>
                    <div class="modal fade" id="confirmacaoExclusao<?= $produto->getCodigo() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de que deseja excluir o produto "
                                    <?= $produto->getNome() ?>"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <a href="/produto/excluir/<?= $produto->getCodigo() ?>" class="btn btn-danger">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p> Vamos adicionar novos produtos</p>
    <?php } ?>
</body>

</html>