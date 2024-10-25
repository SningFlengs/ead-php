<?php
session_start();
include_once 'dbphp.php'; // Inclua seu arquivo de conexão com o banco de dados

// Consulta SQL para buscar todos os cursos
$query = "SELECT titulo, descricao, imagem_path, video_path FROM uploads_videos";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Cursos Disponíveis</title>
    
    <!-- Reset CSS -->
    <link rel="stylesheet" type="text/css" href="../style/reset.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        #logo { width: 80px; height: 80px; object-fit: contain; border-radius: 50%; }
        .header-text { text-align: center; margin-top: 2rem; margin-bottom: 2rem; color: #343a40; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar bg-dark navbar-expand-sm">
            <div class="container">
                <a href="home.php" class="navbar-brand">
                    <img id="logo" src="../images/logo.jpg" alt="Logo Simple Classes">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                    <span class="navbar-toggler-icon"></span> 
                </button>
                <div class="collapse navbar-collapse" id="menuNavbar">
                    <div class="navbar-nav">
                        <a href="#" class="nav-link text-white" style="background-color: #434a51; border-radius: 20px;">Home</a>
                        <?php
                            if (isset($_SESSION["user_email"])) {
                                echo '<a href="conta.php" class="nav-link text-white">Minha conta</a>';
                                echo '<a href="cursos.php" class="nav-link text-white">Meus cursos</a>';
                            } else {
                                echo '<a href="auth/login.php" class="nav-link text-white">Entrar</a>';
                                echo '<a href="auth/login.php" class="nav-link text-white">Meus cursos</a>';
                            }
                        ?>
                    </div>
                </div>
                <form action="" class="d-flex">
                    <div class="input-group">
                        <input type="search" name="" id="" class="form-control me-2" placeholder="Pesquisar cursos">
                        <button type="submit" class="btn btn-outline-success">Buscar</button>
                    </div>
                </form>
            </div>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container my-5">
        <h2 class="header-text">Vamos começar a aprender</h2>
        
        <!-- Grade de Cursos -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            // Exibindo cursos recuperados do banco de dados
            if ($result && mysqli_num_rows($result) > 0) {
                while ($curso = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="col">
                        <div class="card h-100">
                            <img src="' . $curso['imagem_path'] . '" class="card-img-top" alt="' . $curso['titulo'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $curso['titulo'] . '</h5>
                                <p class="card-text">' . $curso['descricao'] . '</p>
                                <a href="' . $curso['video_path'] . '" class="btn btn-primary" target="_blank">Assistir</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p class="text-center">Nenhum curso disponível no momento.</p>';
            }
            ?>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
