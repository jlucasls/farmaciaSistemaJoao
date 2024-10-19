<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $usuario = $_POST['usuario'];
                            $senha = $_POST['senha'];

                            $usuarioCorreto = 'joao';
                            $senhaCorreta = '123';

                            if ($usuario === $usuarioCorreto && $senha === $senhaCorreta) {
                                header("Location: cadastrarMed.php");
                                exit;
                            } else {
                                echo '<div class="alert alert-danger">Usuário ou senha inválidos.</div>';
                            }
                        }
                        ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" name="usuario" class="form-control" id="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" class="form-control" id="senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
