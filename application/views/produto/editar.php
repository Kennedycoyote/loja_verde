<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';

if (isset($data["produto"])) {
    $produto = $data["produto"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>

<body class="container mt-4">

    <h1 class="display-4">Atualizar Produto</h1>
    <hr class="my-4">

    <form method="post" action="/produto/atualizar/<?= $produto->getCodigo() ?>">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= $produto->getNome() ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" name="marca" value="<?= $produto->getMarca() ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" name="preco" value="<?= $produto->getPreco() ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</body>

</html>