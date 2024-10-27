<?php
session_start();
include "dbphp.php"; 

// Verifica se o usuário está logado
if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit;
}

// Obtém o e-mail do usuário logado
$user_email = $_SESSION["user_email"];

// Executa a exclusão do usuário no banco de dados
$query = "DELETE FROM login WHERE email = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $user_email);

if (mysqli_stmt_execute($stmt)) {
    // Se a exclusão for bem-sucedida, encerra a sessão
    session_unset();
    session_destroy();

    // Redireciona para a página inicial ou de login
    header("Location: pages/auth/login.php");
    exit;
} else {
    echo "Erro ao excluir a conta: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
