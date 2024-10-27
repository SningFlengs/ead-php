<?php

session_start();
include 'dbphp.php';

if (!isset($_SESSION["user_email"])) {
    header("location:pages/auth/login.php");
    exit();
}

if (isset($_POST['enviado'])) {

    $user_email = $_SESSION["user_email"]; 

    // Identificando o id do usuário da sessão
    $query = "SELECT id FROM login WHERE email = '$user_email'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    $user_id = $user['id'];

    // Pegando os dados do formulário
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $video = $_FILES["video"];
    $imagem = $_FILES["imagem"];

    // Salvando o vídeo no servidor e obtendo o caminho
    $video_path = "uploads/videos/" . basename($video["name"]);
    move_uploaded_file($video["tmp_name"], $video_path);

    // Salvando a imagem se houver
    $imagem_path = null;
    if (!empty($imagem["name"])) {
        $imagem_path = "uploads/images/" . basename($imagem["name"]);
        move_uploaded_file($imagem["tmp_name"], $imagem_path);
    }

    // Inserindo no banco de dados
    $query = "INSERT INTO uploads_videos (user_id, titulo, video_path, descricao, imagem_path) 
              VALUES ('$user_id', '$titulo', '$video_path', '$descricao', '$imagem_path')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Erro ao salvar no banco de dados: " . mysqli_error($connection));
    } else {
        echo "Upload realizado com sucesso!";
    }

    // Obter o ID do vídeo recém-inserido
    $video_id = mysqli_insert_id($connection);

    // Obtenha as questões do formulário
    $questions = $_POST['questions'] ?? [];

    // Salvando questões (exemplo de inserção)
    foreach ($questions as $question) {
        if (!empty(trim($question))) {
            $query = "INSERT INTO video_questions (video_id, question) VALUES (?, ?)";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "is", $video_id, $question); 
            mysqli_stmt_execute($stmt);
        }
    }

    mysqli_close($connection);

    header("Location: pages/home.php");
    exit();
}
?>
