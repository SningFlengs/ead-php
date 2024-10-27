<?php

session_start();
include "../dbphp.php"; 

if(!isset($_SESSION["user_email"])){
  header("Location:auth/erro.html");
  exit();
}

// Verifica se um ID de vídeo foi passado na URL
if (!isset($_GET['id'])) {
    echo "Vídeo não encontrado.";
    exit;
}

$video_id = $_GET['id'];

// Buscar os detalhes do vídeo com base no ID
$query = "SELECT titulo, descricao, video_path FROM uploads_videos WHERE id = $video_id";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $video = mysqli_fetch_assoc($result);
} else {
    echo "Vídeo não encontrado.";
    exit;
}

// Fechar a conexão após a consulta
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($video['titulo']); ?> - Assistir Vídeo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .video-container {
            max-width: 800px; 
            margin: 30px auto; 
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        video {
            width: 100%; 
            border-radius: 8px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="video-container">
        <h2><?php echo htmlspecialchars($video['titulo']); ?></h2>
        <video controls>
            <source src="<?php echo '../' . htmlspecialchars($video['video_path']); ?>" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
        </video>
        <p><?php echo htmlspecialchars($video['descricao']); ?></p>
        <a href="home.php" class="btn btn-secondary mt-3">Voltar para Home</a>
    </div>
</body>
</html>
