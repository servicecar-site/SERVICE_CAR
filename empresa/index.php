<?php

require_once __DIR__ . '/../includes/auth.php';

exigirTipo('empresa');

require_once __DIR__ . '/../config/conexao.php';

$sql = "SELECT id, nome_fantasia
        FROM empresas
        WHERE usuario_id = ?
        LIMIT 1";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_SESSION['usuario_id']
]);

$empresa = $stmt->fetch();

if (!$empresa) {
    http_response_code(403);
    exit('Cadastro empresarial não encontrado.');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel Empresarial | Service Car</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">

</head>

<body>

    <?php require __DIR__ . '/../includes/header.php'; ?>

    <main class="container" style="min-height: 75vh; padding-block: 40px;">

        <h1>Painel empresarial</h1>

        <h2>
            Bem-vindo,
            <?= htmlspecialchars($empresa['nome_fantasia']) ?>
        </h2>

        <p>Gerencie sua empresa pelo Service Car.</p>

        <p>
            As funcionalidades de gerenciamento de serviços,
            horários e agendamentos serão integradas posteriormente.
        </p>

    </main>

    <?php require __DIR__ . '/../includes/footer.php'; ?>

    <script src="../assets/js/main.js"></script>

</body>
</html>