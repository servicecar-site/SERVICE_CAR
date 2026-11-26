
<?php
$base_url = '/SERVICE_CAR';
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
            <a href="<?= $base_url ?>/login.php"
               class="btn btn-secondary">
                Entrar
            </a>

            <a href="<?= $base_url ?>/cadastro.php"
               class="btn btn-primary">
                Cadastrar
            </a>
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
