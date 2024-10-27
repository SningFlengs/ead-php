<?php
session_start();
include "../dbphp.php"; 

if(!isset($_SESSION["user_email"])){
  header("Location:auth/erro.html");
  exit();
}

// Verifica se um ID de vídeo foi passado na URL
if (!isset($_GET['id'])) {
    echo "Atividade não encontrada.";
    exit;
}

$video_id = $_GET['id'];

// Buscar as questões relacionadas ao vídeo
$query = "SELECT question FROM video_questions WHERE video_id = $video_id";
$result = mysqli_query($connection, $query);
$questions = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row['question'];
    }
}

// Fechar a conexão após a consulta
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Responder Atividade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-activity {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .question-item {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<main>
    <div class="container container-activity">
        <h2>Responder Atividade</h2>
        <?php if (!empty($questions)): ?>
            <form action="../salvar_respostas.php" method="POST">
                <?php foreach ($questions as $index => $question): ?>
                    <div class="question-item">
                        <p><?php echo ($index + 1) . ". " . htmlspecialchars($question); ?></p>
                        <textarea name="answers[]" rows="3" class="form-control" placeholder="Digite sua resposta aqui..."></textarea>
                    </div>
                <?php endforeach; ?>
                <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
                <button type="submit" class="btn btn-primary w-100">Enviar Respostas</button>
            </form>
        <?php else: ?>
            <p>Nenhuma questão disponível para este vídeo.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
