<?php

require_once __DIR__ . '/includes/auth.php';

$_SESSION['csrf_cadastro_cliente'] ??= bin2hex(random_bytes(32));

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Cliente | Service Car</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>

    <?php require __DIR__ . '/includes/header.php'; ?>

    <main class="auth-container">

        <section class="auth-card">

            <h1>Crie sua conta</h1>
            <p>Cadastre-se para agendar serviços automotivos.</p>

            <?php if (isset($_SESSION['erro_cadastro'])): ?>

                <div class="mensagem-erro">
                    <?= htmlspecialchars($_SESSION['erro_cadastro']) ?>
                </div>

                <?php unset($_SESSION['erro_cadastro']); ?>

            <?php endif; ?>

            <form action="api/cadastrar-cliente.php" method="POST">
                <input type="hidden" name="csrf"
       value="<?= htmlspecialchars($_SESSION['csrf_cadastro_cliente']) ?>">

                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome"
                       maxlength="150" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                       maxlength="150" required>

                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone"
                       maxlength="20" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha"
                       minlength="8" required>

                <label for="confirmar_senha">Confirmar senha</label>
                <input type="password" id="confirmar_senha"
                       name="confirmar_senha" required>

                <button type="submit">
                    Criar conta
                </button>

            </form>

            <p class="auth-link">
                Já possui uma conta?
                <a href="login.php">Faça login</a>
            </p>

        </section>

    </main>

    <?php require __DIR__ . '/includes/footer.php'; ?>

</body>
</html>