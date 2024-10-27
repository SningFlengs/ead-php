<!-- Conectando ao banco de dados -->
<?php

session_start();
include "../dbphp.php";

$query = "SELECT id, titulo, descricao, imagem_path AS capa, video_path AS video FROM uploads_videos";
$result = mysqli_query($connection, $query);

// Verifica se houve algum erro na consulta
if (!$result) {
  die("Erro ao buscar vídeos: " . mysqli_error($connection));
}

// Cria um array para armazenar os videos do banco de dados
$videos = [];
while ($row = mysqli_fetch_assoc($result)) {
    $videos[] = $row;
}

mysqli_close($connection);
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
                  <a href="home.php" class="nav-link text-white" style="background-color: #434a51; border-radius: 20px;">Home</a>
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

    <main>

        <div class="row" style="margin-top: 50px">
        <?php
          // Loop pelos vídeos e exibição em colunas
          foreach ($videos as $index => $video) {
              echo '<div class="col-md-4 mb-4 d-flex">';
              echo '  <div class="card w-100">';
              if(empty($video["capa"])){
                echo '<img style="width: 494px; height: 290px " src="../uploads/images/imagem_padrao.jpg" class="card-img-top" alt="Capa padrão">';
              }
              else{
                echo '<img style="width: 494px; height: 290px " src="../' . $video["capa"] . '" class="card-img-top" alt="Capa do ' . htmlspecialchars($video["titulo"]) . '">';
              }
              echo '      <div class="card-body">';
              echo '          <h5 class="card-title">' . htmlspecialchars($video["titulo"]) . '</h5>';
              echo '          <p class="card-text">' . htmlspecialchars($video["descricao"]) . '</p>';
              echo '<a href="player.php?id=' . urlencode($video['id']) . '" class="btn btn-primary" target="_blank">Assistir Vídeo</a>';

              // Verifica se o usuário logado é admin
              if(isset($_SESSION["user_email"])){
                  $user_email = $_SESSION["user_email"];
                  
                  if($user_email === "admin@admin.com"){
                      echo '<a href="editar.php?id=' . urlencode($video['id']) . '" class="btn btn-primary" target="_blank" style="margin-left: 5px">Editar</a>';
                      echo '          <a href="../video_delete.php?id=' . urlencode($video['id']) . '" class="btn" style="background-color: red; color: white;" onclick="return confirm(\'Tem certeza que deseja excluir este vídeo?\');">Excluir</a>';
                      
                      // Adiciona o botão "Ver Respostas" para administradores
                      echo '<a href="respostas.php?id=' . urlencode($video['id']) . '" class="btn btn-info" style="margin-left: 5px">Ver Respostas</a>';
                  }
              }

              echo '      </div>';
              echo '  </div>';
              echo '</div>';
              
              // Quebra de linha a cada 3 vídeos
              if (($index + 1) % 3 == 0) {
                  echo '<div class="w-100"></div>';
              }
          }
          ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>