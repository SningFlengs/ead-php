<?php

include "dbphp.php";

// Verificando se o input submite foi clicado
if(isset($_POST["enviar_cadastro"])){

    $novo_email = $_POST["novo_email"];
    $nova_senha = $_POST["nova_senha"];

// Verificando se algum campo do formulário foi deixado em branco
    if($novo_email == "" || empty($novo_email)){
        header("location:pages/cadastro.php?menssagem_erro=Ambos os campos devem ser preenchidos!");
    }
    elseif($nova_senha == "" || empty($nova_senha)){
        header("location:pages/cadastro.php?menssagem_erro=Ambos os campos devem ser preenchidos!");
    }
    else{
        
        $query = "INSERT INTO login (email, senha) VALUES ('$novo_email', '$nova_senha')";

        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Erro na consulta do banco dados: ".mysqli_error($connection));
        }else{
            header("location:login.html?menssagem_sucesso=Cadastro feito com sucesso");
        }
    }

}


?>