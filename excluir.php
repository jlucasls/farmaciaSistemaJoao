<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $conn = conectarBanco();
    $sql = "DELETE FROM medicamentos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $_SESSION['mensagem'] = "Medicamento excluído com sucesso!";
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro ao excluir medicamento: " . $e->getMessage();
    }

    header("Location: cadastrarMed.php");
    exit;
}
?>
