<?php

require_once __DIR__ . '/../includes/auth.php';

exigirTipo('admin');

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel Administrativo | Service Car</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">

</head>

<body>

    <?php require __DIR__ . '/../includes/header.php'; ?>

    <main class="container" style="min-height: 75vh; padding-block: 40px;">

        <h1>Painel administrativo</h1>

        <h2>
            Bem-vindo,
            <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
        </h2>

        <p>Área restrita à administração do Service Car.</p>

    </main>

    <?php require __DIR__ . '/../includes/footer.php'; ?>

    <script src="../assets/js/main.js"></script>

</body>
</html>