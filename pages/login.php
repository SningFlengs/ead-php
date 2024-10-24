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
    </style>

    <title>Login</title>
</head>
<body style="background-color: #333;">

    <h1 id="titulo">Login Page</h1>

    <div class="container" style="padding-top: 150px;">
        <div class="row justify-content-center">
            <div class="col-md-5 col-md-offset-3">

                <form action="../login.php" method="post">
                    <input type="email" name="user_email" class="form-control" placeholder="Email"><br>
                    <input type="password" name="user_senha" class="form-control" placeholder="Senha"><br>
                    <div class="row" style="margin-left: 1px; gap: 20px;">
                        <input type="submit" value="Login" class="btn btn-primary">
                        <span style="color: aliceblue;">Não possui uma conta? <a href="cadastro.php">Cadastre-se</a></span>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php
        if(isset($_GET["menssagem_erro"])){
            echo "<h6>".$_GET["menssagem_erro"]."</h6>";
        }
    ?>

</body>
</html>