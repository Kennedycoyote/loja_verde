<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';

if (isset($data["msg"])) {
    echo "Sucesso";
}
?>
<form action="/usuario/salvar" method="post" class="form-control">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required class="form-control">

    <label for="email">Email:</label>
    <input type="email" name="email" required class="form-control">

    <label for="senha">Senha:</label>
    <input type="password" name="senha" required class="form-control">

    <button type="submit">Cadastrar</button>
</form>