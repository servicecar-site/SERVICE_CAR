<?php

require_once __DIR__ . '/auth.php';

$base_url = '/SERVICE_CAR';

$logado = estaLogado();
$tipo = $_SESSION['usuario_tipo'] ?? '';

$destinoPainel = match ($tipo) {
    'empresa' => '/empresa/index.php',
    'admin' => '/admin/index.php',
    default => '/index.php'
};

if ($logado) {
    $_SESSION['csrf_logout'] ??= bin2hex(random_bytes(32));
}

?>

<header class="site-header">
    <div class="container header-container">

        <a href="<?= $base_url ?>/index.php" class="logo">
            SERVICE <span>CAR</span>
        </a>

        <nav class="header-nav" id="header-nav">

            <a href="<?= $base_url ?>/index.php">Início</a>
            <a href="<?= $base_url ?>/servicos.php">Serviços</a>
            <a href="<?= $base_url ?>/empresas.php">Empresas</a>
            <a href="<?= $base_url ?>/sobre.php">Sobre nós</a>

        </nav>

        <div class="header-actions">

            <?php if ($logado): ?>

                <span class="header-usuario">
                    Olá, <?= htmlspecialchars(
                        $_SESSION['usuario_nome'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </span>

                <?php if ($tipo === 'empresa' || $tipo === 'admin'): ?>

                    <a href="<?= $base_url . $destinoPainel ?>"
                       class="btn btn-primary">
                        Meu painel
                    </a>

                <?php endif; ?>

                <form action="<?= $base_url ?>/api/logout.php"
                      method="POST"
                      class="form-logout">

                    <input type="hidden"
                           name="csrf"
                           value="<?= htmlspecialchars($_SESSION['csrf_logout']) ?>">

                    <button type="submit" class="btn btn-secondary">
                        Sair
                    </button>

                </form>

            <?php else: ?>

                <a href="<?= $base_url ?>/login.php"
                   class="btn btn-secondary">
                    Entrar
                </a>

                <a href="<?= $base_url ?>/cadastro.php"
                   class="btn btn-primary">
                    Cadastrar
                </a>

            <?php endif; ?>

        </div>

        <button class="menu-toggle"
                id="menu-toggle"
                type="button"
                aria-label="Abrir menu"
                aria-controls="header-nav"
                aria-expanded="false">
            &#9776;
        </button>

    </div>
</header>