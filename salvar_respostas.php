<?php
session_start();
include 'dbphp.php'; 

if(!isset($_SESSION["user_email"])){
    header("Location:pages/auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtendo o ID do vídeo e o email do usuário logado
    $video_id = $_POST['video_id'];
    $user_email = $_SESSION["user_email"];

    // Identificando o id do usuário da sessão
    $query = "SELECT id FROM login WHERE email = '$user_email'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    $user_id = $user['id'];

    // Obtendo as respostas do formulário
    $answers = $_POST['answers'] ?? [];

    // Salvando cada resposta no banco de dados
    foreach ($answers as $answer) {
        if (!empty(trim($answer))) {
            $query = "INSERT INTO video_respostas (video_id, user_id, resposta) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "iis", $video_id, $user_id, $answer);
            mysqli_stmt_execute($stmt);
        }
    }

    // Fechar a conexão
    mysqli_close($connection);

    // Redirecionar para a página de vídeo ou home após enviar respostas
    header("Location: pages/home.php");
    exit();
}
?>
