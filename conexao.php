<?php
function conectarBanco() {
    $host = 'localhost';
    $db = 'farmaciaa'; 
    $user = 'root'; 
    $pass = 'cimatec'; 

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
        exit;
    }
}
?>
