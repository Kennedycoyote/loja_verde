<ul class="nav justify-content-end">
   <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="/home/index">Início</a>
   </li>
   <?php if (isset($_SESSION['usuario'])) { ?>
      <li class="nav-item">
         <a class="nav-link" href="/produto/index">Produto</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="/usuario/index">Usuário</a>
      </li>
      <li class="nav-item">
         <span class="nav-link">Bem-vindo,
            <?= $_SESSION['usuario']->getNome(); ?>
         </span>
      </li>
      <li class="nav-item">
         <a class="nav-link btn btn-danger" href="/usuario/logout">Logout</a>
      </li>
   <?php } else { ?>
      <li class="nav-item">
         <a class="nav-link" href="/usuario/login">Login</a>
      </li>
   <?php } ?>
</ul>