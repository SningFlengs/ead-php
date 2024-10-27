<?php

session_start();
include "../dbphp.php";

if(!isset($_SESSION["user_email"])){
  header("Location:auth/erro.html");
  exit();
}else{
  $user_email = $_SESSION["user_email"];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="../style/reset.css">
    <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{margin: 0;}
    </style>
</head>
<body>
    <header>
        <nav class="navbar bg-dark navbar-expand-sm">
            <div class="container">
                <a href="home.php" class="navbar-brand">
                    <img id="logo" src="../images/logo.jpg" alt="logo simple classes">
                </a>

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar"><span class="navbar-toggler-icon"></span> </button>

              <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav">
                  <!-- Links do navbar -->
                  <a href="home.php" class="nav-link text-white">Home</a>
                  <!-- Verifica se o usuário está logado -->
                  
                  <?php
                    if(isset($_SESSION["user_email"])){
                      echo '<a style="background-color: #434a51; border-radius: 20px;" href="conta.php" class="nav-link text-white">Minha conta</a>';
                    }
                    else{
                      echo '<a href="login.php" class="nav-link text-white">Entrar</a>';
                    }
                  ?>

                  <?php

                  if(isset($_SESSION["user_email"])){
                    echo '<a href="mensagem.php" class="nav-link text-white">Mensagens</a>';
                  }
                    
                  ?>

                </div>
              </div>
              <form action="" class="d-flex">
                <div class="input-group"><input type="search" name="" id="" class="form-control me-2" placeholder="Pesquisar cursos"><button type="submit" class="btn btn-outline-success">Buscar</button></div>
              </form>
            </div>
          </nav>
    </header>

    <main class="d-flex justify-content-center align-items-center" style="margin-top: 100px">
      <div class="account-container p-4 rounded shadow" style="background-color: #f8f9fa; width: 600px; text-align: center;">
          <h2 class="mb-4">Minha Conta</h2>
          <ul class="account-options list-unstyled">
              <li class="mb-3">
                  
                  <?php
                    if ($user_email === "admin@admin.com") {
                      echo '<a href="envio.php" class="btn btn-upload btn-block" style="background-color: #17a2b8; color: white; width: 100%;">Enviar Vídeo</a>';
                    }
                  ?>
        
              </li>
      
              <li class="mb-3">
                <a href="../excluir_conta.php" class="btn btn-delete btn-block" style="background-color: #dc3545; color: white; width: 100%;" onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">Excluir Conta</a>

              </li>
              <li>
                <a href="../logout.php" class="btn btn-logout btn-block" style="background-color: #6c757d; color: white; width: 100%;">Sair da Conta</a>
              </li>
          </ul>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>