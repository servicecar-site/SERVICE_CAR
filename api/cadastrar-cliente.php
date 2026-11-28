<?php

session_start();

require __DIR__ . '/../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../cadastro-cliente.php');
    exit;
}

function erroCadastro($mensagem)
{
    $_SESSION['erro_cadastro'] = $mensagem;

    header('Location: ../cadastro-cliente.php');
    exit;
}
// Validar token CSRF

$token = $_POST['csrf'] ?? '';

if (
    !is_string($token) ||
    !isset($_SESSION['csrf_cadastro_cliente']) ||
    !hash_equals($_SESSION['csrf_cadastro_cliente'], $token)
) {
    erroCadastro('Solicitação inválida. Tente novamente.');
}
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

if (
    $nome === '' ||
    $email === '' ||
    $telefone === '' ||
    $senha === ''
) {
    erroCadastro('Preencha todos os campos.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    erroCadastro('Informe um e-mail válido.');
}

if (
    mb_strlen($nome) > 150 ||
    mb_strlen($email) > 150 ||
    mb_strlen($telefone) > 20
) {
    erroCadastro('Dados acima do tamanho permitido.');
}

if (strlen($senha) < 8 || strlen($senha) > 72) {
    erroCadastro('A senha deve ter entre 8 e 72 bytes.');
}

if ($senha !== $confirmarSenha) {
    erroCadastro('As senhas não coincidem.');
}

try {

    $sql = "SELECT id FROM usuarios WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        erroCadastro('Este e-mail já está cadastrado.');
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios
            (nome, email, telefone, senha_hash, tipo)
            VALUES (?, ?, ?, ?, 'cliente')";

    $stmt = $pdo->prepare($sql);

       $stmt->execute([
        $nome,
        $email,
        $telefone,
        $senhaHash
    ]);

    unset($_SESSION['csrf_cadastro_cliente']);

    $_SESSION['sucesso_cadastro'] =
        'Cadastro realizado com sucesso!';

    header('Location: ../login.php');
    exit;

} catch (PDOException $erro) {

    error_log($erro->getMessage());

    erroCadastro('Não foi possível realizar o cadastro.');

}