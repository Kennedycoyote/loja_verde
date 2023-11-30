<?php
$base = __DIR__;
include $base . '\..\layout\menu.php';
?>

<body class="container mt-4">

    <h1 class="display-4">Bem vindo </h1>
    <hr class="my-4">

    <div class="container mt-5">
        <form action="/usuario/login" method="post">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>