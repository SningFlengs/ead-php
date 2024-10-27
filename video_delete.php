<?php

include "auth-admin.php";

include "dbphp.php";


if (isset($_SESSION["user_email"]) && isset($_GET['id'])) {
    
    $video_id = $_GET['id'];

    // Exclui o vídeo do banco de dados baseado no ID
    $query = "DELETE FROM uploads_videos WHERE id = '$video_id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Vídeo excluído com sucesso!";
    } else {
        echo "Erro ao excluir o vídeo: " . mysqli_error($connection);
    }

    mysqli_close($connection);

    header("Location: pages/home.php");
    exit();
}
?>