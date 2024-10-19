<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    $conn = conectarBanco();
    $sql = "UPDATE medicamentos SET nome = :nome, preco = :preco, quantidade = :quantidade, categoria = :categoria, validade = :validade WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':validade', $validade);
    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $_SESSION['mensagem'] = "Medicamento atualizado com sucesso!";
        header("Location: cadastrarMed.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro ao atualizar medicamento: " . $e->getMessage();
    }
}

// Carregar dados do medicamento para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = conectarBanco();
    $sql = "SELECT * FROM medicamentos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $medicamento = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h4>Editar Medicamento</h4>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $medicamento['id']; ?>">
            <div class="form-group">
                <label for="nome">Nome do Medicamento:</label>
                <input type="text" class="form-control" name="nome" value="<?php echo htmlspecialchars($medicamento['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="preco">Preço Unitário:</label>
                <input type="number" class="form-control" name="preco" value="<?php echo htmlspecialchars($medicamento['preco']); ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade em Estoque:</label>
                <input type="number" class="form-control" name="quantidade" value="<?php echo htmlspecialchars($medicamento['quantidade']); ?>" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select class="form-control" name="categoria" required>
                    <option <?php if ($medicamento['categoria'] == 'Analgesico') echo 'selected'; ?>>Analgesico</option>
                    <option <?php if ($medicamento['categoria'] == 'Antibiotico') echo 'selected'; ?>>Antibiotico</option>
                    <option <?php if ($medicamento['categoria'] == 'Anti-inflamatorio') echo 'selected'; ?>>Anti-inflamatorio</option>
                </select>
            </div>
            <div class="form-group">
                <label for="validade">Data de Validade:</label>
                <input type="date" class="form-control" name="validade" value="<?php echo htmlspecialchars($medicamento['validade']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button> 
        </form>
    </div>
</body>
</html>
