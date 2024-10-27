<?php
include "../auth-admin.php";
include "../dbphp.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="../style/reset.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Envio</title>
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
                      echo '<a href="auth/login.php" class="nav-link text-white">Entrar</a>';
                    }
                  ?>

                  <?php
                    if(isset($_SESSION["user_email"])){
                      $user_email = $_SESSION["user_email"];

                      if ($user_email === "admin@admin.com") {
                        echo '<a class="nav-link text-white" href="menssagens-admin.php">Menssagens</a>';
                      }
                      else{
                        echo '<a class="nav-link text-white" href="menssagens.php">Menssagens</a>';
                      }
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
    
    <main class="container my-5">
    <form action="../video_upload.php" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
        
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Vídeo:</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Vídeo:</label>
            <textarea name="descricao" rows="4" class="form-control"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="imagem" class="form-label">Selecione a capa do vídeo:</label>
            <input type="file" name="imagem" accept="image/*" class="form-control">
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Selecione o vídeo (formato MP4):</label>
            <input type="file" name="video" accept="video/mp4" class="form-control" required>
        </div>
        
        <button type="submit" name="enviado" class="btn btn-primary w-100">Enviar Vídeo</button>
    </form>
</main>
        
</body>
</html>