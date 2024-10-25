<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
                      echo '<a href="conta.php" class="nav-link text-white">Minha conta</a>';
                    }
                    else{
                      echo '<a href="login.php" class="nav-link text-white">Entrar</a>';
                    }
                  ?>

                  <?php
                    if(isset($_SESSION["user_email"])){
                      echo '<a style="background-color: #434a51; border-radius: 20px;" href="cursos.php" class="nav-link text-white">Meus cursos</a>';
                    }
                    else{
                      echo '<a href="login.php" class="nav-link text-white">Meus cursos</a>';
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>