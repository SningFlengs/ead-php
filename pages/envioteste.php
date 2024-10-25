<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>envio</title>
</head>
<body>
    <form action="../video_upload.php" method="post" enctype="multipart/form-data">
        
        <label for="titulo">Título do Vídeo:</label>
        <input type="text" name="titulo"required><br><br>
        
        <label for="descricao">Descrição do Vídeo:</label>
        <textarea name="descricao" rows="4" cols="50"></textarea><br><br>
        
        <label for="video_file">Selecione a capa do vídeo:</label>
        <input type="file" name="imagem" accept="image/*"><br><br>

        <label for="video_file">Selecione o vídeo (formato MP4):</label>
        <input type="file" name="video" accept="video/mp4" required><br><br>
        
        <input type="submit" name="enviado" value="Enviar Vídeo">
    </form>
</body>
</html>