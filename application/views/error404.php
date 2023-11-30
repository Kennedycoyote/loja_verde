<?php
$base = __DIR__;
include $base . '\layout\menu.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 404</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 50px;
    }

    .error-container {
      text-align: center;
      padding: 30px;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 100px;
      color: #dc3545;
    }

    img {
      width: 300px;
      margin-top: 20px;
    }

    p {
      font-size: 18px;
      color: #6c757d;
    }

    a {
      color: #007bff;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-12 text-center error-container">
        <h1> Error 404 </h1>
        <img src="../assets/img/erro.png" alt="Erro">
        <p>A página que você está procurando não foi encontrada.</p>
        <p>Volte para <a href="/">a página inicial</a>.</p>
      </div>
    </div>
  </div>

</body>

</html>