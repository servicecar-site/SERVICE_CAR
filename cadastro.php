<?php
require_once __DIR__ . '/includes/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Escolha seu cadastro | Service Car</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>

    <?php require __DIR__ . '/includes/header.php'; ?>

    <main class="auth-container">

        <section class="auth-card cadastro-selecao">

            <h1>Crie sua conta</h1>

            <p>Escolha como deseja utilizar o Service Car.</p>

            <div class="opcoes-cadastro">

                <a href="cadastro-cliente.php" class="opcao-cadastro">

                    <h2>Sou cliente</h2>

                    <p>
                        Encontre empresas e agende serviços
                        para o seu veículo.
                    </p>

                    <span>Cadastrar como cliente</span>

                </a>

                <a href="cadastro-empresa.php" class="opcao-cadastro">

                    <h2>Sou empresa</h2>

                    <p>
                        Divulgue seus serviços e gerencie
                        seus agendamentos.
                    </p>

                    <span>Cadastrar como empresa</span>

                </a>

            </div>

            <p class="auth-link">
                Já possui uma conta?
                <a href="login.php">Faça login</a>
            </p>

        </section>

    </main>

    <?php require __DIR__ . '/includes/footer.php'; ?>

</body>
</html>