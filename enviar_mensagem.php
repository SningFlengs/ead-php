<?php
session_start();
include "dbphp.php"; 

// Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $remetente = $_POST['remetente'];
    $destinatario = $_POST['destinatario'];
    $message = trim($_POST['message']);
    
    // Verifica se todos os campos estão preenchidos
    if (!empty($remetente) && !empty($destinatario) && !empty($message)) {
        $query = "INSERT INTO messages (remetente, destinatario, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sss", $remetente, $destinatario, $message);
        
        if (mysqli_stmt_execute($stmt)) {
            // Redireciona de volta para a página de mensagens
            header("Location: /projetos/trabai/pages/mensagem.php?chat_with=" . urlencode($destinatario));
            exit;
        } else {
            echo "Erro ao enviar a mensagem: " . mysqli_error($connection);
        }
    }
}

mysqli_close($connection);
?>
