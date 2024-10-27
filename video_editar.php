<?php
include "../auth-admin.php";
include "dbphp.php";

$video_id = $_POST['id'];
$new_title = $_POST['titulo'];
$new_description = $_POST['descricao'];

// Buscar os valores atuais do vídeo no banco de dados
$query = "SELECT titulo, descricao FROM uploads_videos WHERE id = $video_id";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $video = mysqli_fetch_assoc($result);
} else {
    echo "Vídeo não encontrado.";
    exit;
}

// Verificar se os campos estão vazios do formulário estão vazios
if (trim($new_title) === '') {
    $new_title = $video['titulo']; 
}

if (trim($new_description) === '') {
    $new_description = $video['descricao']; // Manter a descrição atual se o campo estiver vazio
}

// Atualizar os dados no banco de dados
$update_query = "UPDATE uploads_videos SET titulo = '$new_title', descricao = '$new_description' WHERE id = $video_id";
if (mysqli_query($connection, $update_query)) {
    header("Location: pages/home.php");
    exit;
} else {
    echo "Erro ao atualizar o vídeo: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
?>
