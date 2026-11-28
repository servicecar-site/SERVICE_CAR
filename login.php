<?php

session_start();

$_SESSION['csrf_login'] ??= bin2hex(random_bytes(32));

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Service Car</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/auth.css">

</head>

<body>

    <?php require __DIR__ . '/includes/header.php'; ?>

    <main class="auth-container">

        <section class="auth-card">

            <h1>Bem-vindo ao Service Car</h1>

            <p>Acesse sua conta para continuar.</p>

            <?php if (isset($_SESSION['sucesso_cadastro'])): ?>

                <div class="mensagem-sucesso">
                    <?= htmlspecialchars($_SESSION['sucesso_cadastro']) ?>
                </div>

                <?php unset($_SESSION['sucesso_cadastro']); ?>

            <?php endif; ?>

            <?php if (isset($_SESSION['erro_login'])): ?>

                <div class="mensagem-erro">
                    <?= htmlspecialchars($_SESSION['erro_login']) ?>
                </div>

                <?php unset($_SESSION['erro_login']); ?>

            <?php endif; ?>

            <form action="api/autenticar.php" method="POST">

                <input type="hidden" name="csrf"
                       value="<?= htmlspecialchars($_SESSION['csrf_login']) ?>">

                <label for="email">E-mail</label>

                <input type="email"
                       id="email"
                       name="email"
                       maxlength="150"
                       autocomplete="email"
                       required>

                <label for="senha">Senha</label>

                <input type="password"
                       id="senha"
                       name="senha"
                       autocomplete="current-password"
                       required>

                <button type="submit">Entrar</button>

            </form>

            <p class="auth-link">
                Ainda não possui uma conta?
                <a href="cadastro.php">Cadastre-se</a>
            </p>

        </section>

    </main>

    <?php require __DIR__ . '/includes/footer.php'; ?>

</body>
</html>