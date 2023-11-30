<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';

if (isset($data["usuario"])) {
    $usuario = $data["usuario"];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>

<body class="container mt-4">

    <h1 class="display-4">Atualizar Usuário</h1>
    <hr class="my-4">

    <form method="post" action="/usuario/atualizar/<?= $usuario->getId() ?>">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= $usuario->getNome() ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $usuario->getEmail() ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</body>

</html>