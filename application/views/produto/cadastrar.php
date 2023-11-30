<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';

if (isset($data["msg"])) {
    echo " Sucesso";
}
?>
<form action="/produto/salvar" method="POST" class="form-control" enctype="multipart/form-data">

    <label> Nome Produto </label>
    <input type="text" name="nome_produto" class="form-control" />

    <label> Marca </label>
    <input type="text" name="marca" class="form-control" />

    <label>Preço</label>
    <input type="number" name="preco" class="form-control" required>

    <label for="imagem">Imagem:</label>
    <input type="file" name="imagem" accept="image/*">

    <input type="submit" value="Cadastrar" class="form-control" />
</form>