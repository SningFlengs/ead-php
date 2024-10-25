<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style/header.css">

    <style>
        h6{
            margin-top: 50px;
            text-align: center;
            color: yellow;
        }
        #titulo {
            text-align: center;
            color: #fff;
            padding: 20px;
            letter-spacing: 2px;
            font-weight: 500;
        }  
    </style>

    <title>Cadastro</title>
</head>
<body style="background-color: #333;">

    <h1 id="titulo">Register Page</h1>

    <div class="container" style="padding-top: 150px;">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-offset-3">
                <form action="../../cadastro.php" method="post">
                    <input type="email" name="novo_email" class="form-control" placeholder="Email"><br>
                    <input type="password" name="nova_senha" class="form-control" placeholder="Senha"><br>
                    <input type="submit" value="Cadastrar" class="btn btn-primary" name="enviar_cadastro">
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_GET["menssagem_erro"])){
            echo "<h6>".$_GET["menssagem_erro"]."</h6>";
        }
        if(isset($_GET["menssagem_sucesso"])){
            echo "<h6>".$_GET["menssagem_sucesso"]."</h6>";
            
        }
    ?>

</body>
</html>