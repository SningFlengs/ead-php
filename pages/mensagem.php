<?php
session_start();
include "../dbphp.php"; // Inclua sua conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION["user_email"])) {
    header("Location: auth/erro.html");
    exit;
}

$user_email = $_SESSION["user_email"];
$is_admin = $user_email === "admin@admin.com";

// Buscar a lista de usuários (exceto admin) para o administrador
$users = [];
if ($is_admin) {
    $query = "SELECT DISTINCT email FROM login WHERE email != 'admin@admin.com'";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row['email'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mensagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="../style/reset.css">
</head>
<body>
    
<header>
        <nav class="navbar bg-dark navbar-expand-sm">
            <div class="container">

              <a href="home.php" class="navbar-brand">
                <img id="logo" src="../images/logo.jpg" alt="logo simple classes">
              </a>

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar"><span class="navbar-toggler-icon"></span> </button>

              <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav">
                  <!-- Links do navbar -->
                  <a href="home.php" class="nav-link text-white">Home</a>
                  <!-- Verifica se o usuário está logado -->
                  
                  <?php
                    if(isset($_SESSION["user_email"])){
                      echo '<a href="conta.php" class="nav-link text-white">Minha conta</a>';
                    }
                    else{
                      echo '<a href="auth/login.php" class="nav-link text-white">Entrar</a>';
                    }
                  ?>

                  <?php

                    if(isset($_SESSION["user_email"])){
                      echo '<a href="menssagem.php" class="nav-link text-white" style="background-color: #434a51; border-radius: 20px;">Mensagens</a>';
                    }
                      
                  ?>
                  
                  
                </div>
              </div>
              <form action="" class="d-flex">
                <div class="input-group"><input type="search" name="" id="" class="form-control me-2" placeholder="Pesquisar cursos"><button type="submit" class="btn btn-outline-success">Buscar</button></div>
              </form>
            </div>
          </nav>
    </header>

    <main>
        <div class="container-fluid mt-4 d-flex" style="height: 80vh;">
            <?php if ($is_admin): ?>
            <!-- Barra lateral para administradores com uma lista de usuários -->
            <div class="bg-light border-end p-3" style="width: 250px; overflow-y: auto;">
                <h5>Conversas</h5>
                <ul class="list-group">
                    <?php foreach ($users as $user): ?>
                        <li class="list-group-item d-flex align-items-center">
                            <a href="?chat_with=<?php echo urlencode($user); ?>" class="text-decoration-none text-dark d-flex align-items-center">
                                <img src="../images/logo.jpg" alt="Ícone do usuário" class="me-2" style="width: 20px; height: 20px;">
                                <?php echo htmlspecialchars($user); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Janela de chat -->
            <div class="chat-window">
                <div class="message-box border mb-3 p-3 overflow-auto" style="height: 60vh;" id="messageBox">
                    <?php
                    // Verifica qual usuário está sendo conversado (para admin)
                    $chat_with = $is_admin ? ($_GET['chat_with'] ?? '') : 'admin@admin.com';
                    
                    // Carregar o histórico de mensagens do banco de dados
                    $query = "SELECT * FROM messages WHERE 
                            (remetente = '$user_email' AND destinatario = '$chat_with') 
                            OR (remetente = '$chat_with' AND destinatario = '$user_email') 
                            ORDER BY timestamp ASC";
                    $result = mysqli_query($connection, $query);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $remetente = htmlspecialchars($row['remetente']);
                            $mensagem = htmlspecialchars($row['message']);
                            $data_hora = date("d/m/Y H:i", strtotime($row['timestamp']));
                            
                            echo "<p><strong>$remetente:</strong> $mensagem <small class='text-muted'>($data_hora)</small></p>";
                        }
                    } else {
                        echo "<p class='text-muted'>Nenhuma mensagem ainda.</p>";
                    }
                    ?>
                </div>

                <!-- Campo de input para enviar mensagem -->
                <form action="../enviar_mensagem.php" method="POST">
                    <input type="hidden" name="remetente" value="<?php echo htmlspecialchars($user_email); ?>">
                    <input type="hidden" name="destinatario" value="<?php echo $is_admin ? htmlspecialchars($chat_with) : 'admin@admin.com'; ?>">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Digite sua mensagem...">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
