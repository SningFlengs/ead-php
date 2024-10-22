<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "auth");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Pegando dados do formulário HTML
    $email = $_POST["user_email"];
    $senha = $_POST["user_senha"];

    // Conectando com o Banco de Dados
    $connection = mysqli_connect(HOSTNAME,USERNAME, PASSWORD, DATABASE);

    if(!$connection){
        die("Erro na conexão com o banco de dados.");
    }

    // Validando autenticação de Login
    $query = "SELECT * FROM login WHERE email='$email' AND senha='$senha'";

    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        mysqli_close($connection);
        header("Location: pages/sucesso.html");
        exit();
    }else{
        mysqli_close($connection);
        header("Location: pages/erro.html");
        exit();
    }

}



?>