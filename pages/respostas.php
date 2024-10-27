<?php
session_start();
include "../dbphp.php"; 

if (!isset($_SESSION["user_email"]) || $_SESSION["user_email"] !== "admin@admin.com") {
    header("Location:auth/erro.html");
    exit();
}

// Verifica se um ID de vídeo foi passado na URL
if (!isset($_GET['id'])) {
    echo "Atividade não encontrada.";
    exit();
}

$video_id = $_GET['id'];

// Buscar a lista de usuários que responderam para aquele vídeo específico
$query = "SELECT DISTINCT l.email AS usuario_email, l.id AS usuario_id 
          FROM video_respostas v 
          JOIN login l ON v.user_id = l.id 
          WHERE v.video_id = $video_id";
$result = mysqli_query($connection, $query);
$usuarios = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $usuarios[] = $row;
    }
}

// Variável para armazenar o e-mail do usuário selecionado
$usuario_email = "";
$respostas = [];
if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    // Buscar o e-mail do usuário selecionado
    $query_email = "SELECT email FROM login WHERE id = $usuario_id";
    $result_email = mysqli_query($connection, $query_email);
    if ($result_email && mysqli_num_rows($result_email) > 0) {
        $usuario_email = mysqli_fetch_assoc($result_email)['email'];
    }

    // Buscar as respostas desse usuário para o vídeo específico
    $query = "SELECT resposta, data_resposta 
              FROM video_respostas 
              WHERE video_id = $video_id AND user_id = $usuario_id";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $respostas[] = $row;
        }
    }
}

// Fechar a conexão após a consulta
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Respostas dos Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-respostas {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .usuario-item {
            margin-bottom: 15px;
        }
        .resposta-item {
            margin-bottom: 15px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
<main>
    <div class="container container-respostas">
        <h2>Usuários que Responderam</h2>
        <!-- Exibir lista de botões para cada usuário -->
        <?php if (!empty($usuarios)): ?>
            <?php foreach ($usuarios as $usuario): ?>
                <div class="usuario-item">
                    <a href="?id=<?php echo urlencode($video_id); ?>&usuario_id=<?php echo urlencode($usuario['usuario_id']); ?>" class="btn btn-primary">
                        <?php echo htmlspecialchars($usuario['usuario_email']); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma resposta encontrada para este vídeo.</p>
        <?php endif; ?>

        <!-- Exibir respostas do usuário selecionado -->
        <?php if (!empty($respostas)): ?>
            <h3 class="mt-4">Respostas de <?php echo htmlspecialchars($usuario_email); ?></h3>
            <?php foreach ($respostas as $resposta): ?>
                <div class="resposta-item">
                    <p><?php echo htmlspecialchars($resposta['resposta']); ?></p>
                    <small>Data: <?php echo htmlspecialchars($resposta['data_resposta']); ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="home.php" class="btn btn-secondary mt-3">Voltar para Home</a>
    </div>
</main>
</body>
</html>
