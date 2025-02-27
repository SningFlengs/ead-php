<?php
include "../auth-admin.php";
include "../dbphp.php";

// Verifica se o usuário é administrador e se um ID foi passado
if (!isset($_SESSION["user_email"]) || $_SESSION["user_email"] !== "admin@admin.com" || !isset($_GET['id'])) {
    header("Location: home.php");
    exit;
}

$video_id = $_GET['id'];

// Buscar os detalhes do vídeo para preencher o formulário
$query = "SELECT titulo, descricao FROM uploads_videos WHERE id = $video_id";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $video = mysqli_fetch_assoc($result);
} else {
    echo "Vídeo não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Vídeo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/reset.css">
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
        <div class="container mt-5">
            <h2>Editar Vídeo</h2>
            <form action="../video_editar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($video_id); ?>">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo htmlspecialchars($video['titulo']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="4"><?php echo htmlspecialchars($video['descricao']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="home.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </main>
</body>
</html>
