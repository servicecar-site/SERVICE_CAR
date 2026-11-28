<?php

require_once __DIR__ . '/includes/auth.php';

$_SESSION['csrf_cadastro_empresa'] ??= bin2hex(random_bytes(32));

$dados = $_SESSION['dados_cadastro_empresa'] ?? [];

unset($_SESSION['dados_cadastro_empresa']);

function valorAnterior(string $campo): string
{
    global $dados;

    return htmlspecialchars(
        $dados[$campo] ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Empresa | Service Car</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/auth.css">

</head>

<body>

    <?php require __DIR__ . '/includes/header.php'; ?>

    <main class="auth-container">

        <section class="auth-card cadastro-empresa">

            <h1>Cadastre sua empresa</h1>
            <p>Faça parte do Service Car.</p>

            <?php if (isset($_SESSION['erro_cadastro_empresa'])): ?>

                <div class="mensagem-erro">
                    <?= htmlspecialchars($_SESSION['erro_cadastro_empresa']) ?>
                </div>

                <?php unset($_SESSION['erro_cadastro_empresa']); ?>

            <?php endif; ?>

            <form action="api/cadastrar-empresa.php" method="POST">

                <input type="hidden" name="csrf"
                       value="<?= htmlspecialchars($_SESSION['csrf_cadastro_empresa']) ?>">

                <h2>Dados do responsável</h2>

                <label for="nome">Nome completo</label>

                <input type="text"
                       id="nome"
                       name="nome"
                       value="<?= valorAnterior('nome') ?>"
                       maxlength="150"
                       required>

                <label for="email">E-mail de acesso</label>

                <input type="email"
                       id="email"
                       name="email"
                       value="<?= valorAnterior('email') ?>"
                       maxlength="150"
                       required>

                <label for="senha">Senha</label>

                <input type="password"
                       id="senha"
                       name="senha"
                       minlength="8"
                       autocomplete="new-password"
                       required>

                <label for="confirmar_senha">Confirmar senha</label>

                <input type="password"
                       id="confirmar_senha"
                       name="confirmar_senha"
                       autocomplete="new-password"
                       required>

                <h2>Dados da empresa</h2>

                <label for="razao_social">Razão social</label>

                <input type="text"
                       id="razao_social"
                       name="razao_social"
                       value="<?= valorAnterior('razao_social') ?>"
                       maxlength="150"
                       required>

                <label for="nome_fantasia">Nome fantasia</label>

                <input type="text"
                       id="nome_fantasia"
                       name="nome_fantasia"
                       value="<?= valorAnterior('nome_fantasia') ?>"
                       maxlength="150"
                       required>

                <label for="cnpj">CNPJ</label>

                <input type="text"
                       id="cnpj"
                       name="cnpj"
                       value="<?= valorAnterior('cnpj') ?>"
                       maxlength="18"
                       required>

                <label for="telefone">Telefone comercial</label>

                <input type="tel"
                       id="telefone"
                       name="telefone"
                       value="<?= valorAnterior('telefone') ?>"
                       maxlength="20"
                       required>

                <label for="email_comercial">E-mail comercial</label>

                <input type="email"
                       id="email_comercial"
                       name="email_comercial"
                       value="<?= valorAnterior('email_comercial') ?>"
                       maxlength="150">

                <h2>Endereço comercial</h2>

                <label for="cep">CEP</label>

                <input type="text"
                       id="cep"
                       name="cep"
                       value="<?= valorAnterior('cep') ?>"
                       maxlength="9"
                       required>

                <label for="rua">Rua</label>

                <input type="text"
                       id="rua"
                       name="rua"
                       value="<?= valorAnterior('rua') ?>"
                       maxlength="150"
                       required>

                <label for="numero">Número</label>

                <input type="text"
                       id="numero"
                       name="numero"
                       value="<?= valorAnterior('numero') ?>"
                       maxlength="20"
                       required>

                <label for="complemento">Complemento</label>

                <input type="text"
                       id="complemento"
                       name="complemento"
                       value="<?= valorAnterior('complemento') ?>"
                       maxlength="100">

                <label for="bairro">Bairro</label>

                <input type="text"
                       id="bairro"
                       name="bairro"
                       value="<?= valorAnterior('bairro') ?>"
                       maxlength="100"
                       required>

                <label for="cidade">Cidade</label>

                <input type="text"
                       id="cidade"
                       name="cidade"
                       value="<?= valorAnterior('cidade') ?>"
                       maxlength="100"
                       required>

                <label for="estado">Estado (UF)</label>

                <input type="text"
                       id="estado"
                       name="estado"
                       value="<?= valorAnterior('estado') ?>"
                       maxlength="2"
                       placeholder="MG"
                       required>

                <label for="descricao">Descrição da empresa</label>

                <textarea id="descricao"
                          name="descricao"
                          rows="4"
                          maxlength="2000"><?= valorAnterior('descricao') ?></textarea>

                <button type="submit">
                    Cadastrar empresa
                </button>

            </form>

            <p class="auth-link">
                Já possui uma conta?
                <a href="login.php">Faça login</a>
            </p>

            <p class="auth-link">
                <a href="cadastro.php">Voltar</a>
            </p>

        </section>

    </main>

       <?php require __DIR__ . '/includes/footer.php'; ?>

    <script src="assets/js/cadastro-empresa.js?v=1"></script>

</body>
</html>