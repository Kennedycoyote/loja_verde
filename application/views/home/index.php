<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';

if (isset($data["produtos"])) {
    $produtos = $data["produtos"];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>

<body class="container mt-4">

    <h1 class="display-4">Produtos Disponíveis</h1>
    <hr class="my-4">

    <?php if (isset($produtos) && is_array($produtos)) { ?>

        <div class="row">
            <?php foreach ($produtos as $produto) { ?>

                <div class="col-md-4 mb-4">

                    <div class="card-body">

                        <img src="<?= $produto->getImagemUrl() ?>" class="card-img-top img-fluid" alt="Produto"
                            style="object-fit: center; width: 200px; height: 250px;">
                        <div class="card-body">

                            <h5 class="card-title">
                                <?= $produto->getNome() ?>
                            </h5>

                            <p class="card-text">
                                <?= $produto->getMarca() ?> - R$
                                <?= $produto->getPreco() ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="alert alert-info text-center">Nenhum produto disponível.</p>
    <?php } ?>
</body>

</html>