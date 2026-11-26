
<footer class="site-footer">
    <div class="container footer-container">

        <!-- Identidade da empresa -->
        <div class="footer-col">
            <h2 class="footer-logo">SERVICE CAR</h2>

            <p>
                Conectamos você aos melhores serviços
                automotivos, com praticidade, segurança
                e qualidade.
            </p>
        </div>

        <!-- Navegação -->
        <div class="footer-col">
            <h3>Navegação</h3>

            <a href="<?= $base_url ?>/index.php">Início</a>
            <a href="<?= $base_url ?>/servicos.php">Serviços</a>
            <a href="<?= $base_url ?>/empresas.php">Empresas</a>
            <a href="<?= $base_url ?>/sobre.php">Sobre nós</a>
        </div>

        <!-- Área do cliente -->
        <div class="footer-col">
            <h3>Minha conta</h3>

            <a href="<?= $base_url ?>/login.php">Entrar</a>
            <a href="<?= $base_url ?>/cadastro.php">Criar conta</a>
        </div>

        <!-- Atendimento -->
        <div class="footer-col">
            <h3>Atendimento</h3>

            <p>Segunda a sexta-feira</p>
            <p>08h às 18h</p>
        </div>

    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>
                &copy; <?= date('Y') ?> Service Car.
                Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>
