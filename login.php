<?php

include "dbphp.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Pegando dados do formulário HTML
    $email = $_POST["user_email"];
    $senha = $_POST["user_senha"];

    // Validando autenticação de Login
    $query = "SELECT * FROM login WHERE email='$email' AND senha='$senha'";

    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        mysqli_close($connection);
        header("Location:pages/sucesso.html");
        exit();
    }else{
        mysqli_close($connection);
        header("Location:pages/login.php?menssagem_erro=Erro no login");
        exit();
    }

}



?>