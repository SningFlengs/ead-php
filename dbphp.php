<?php

define("HOSTNAME", "localhost:3307");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "auth");

// Conectando com o Banco de Dados
$connection = mysqli_connect(HOSTNAME,USERNAME, PASSWORD, DATABASE);

if(!$connection){
    die("Erro na conexão com o banco de dados.");
}
?>