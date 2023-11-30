<form method="post" action="/usuario/pesquisarPorNome">
    <label for="nome_usuario">Nome do Usuário:</label>
    <input type="text" name="nome_usuario" id="nome_usuario">
    <button type="submit">Pesquisar</button>
</form>

<!-- Exibir os resultados -->
<?php if (!empty($data['usuarios'])): ?>
    <h2>Resultados da Pesquisa:</h2>
    <ul>
        <?php foreach ($data['usuarios'] as $usuario): ?>
            <li>
                <?= $usuario->getNome() ?> -
                <?= $usuario->getEmail() ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>