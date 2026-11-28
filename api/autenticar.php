<?php

session_start();

function erroLogin($mensagem)
{
    $_SESSION['erro_login'] = $mensagem;

    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$token = $_POST['csrf'] ?? '';

if (
    !is_string($token) ||
    !isset($_SESSION['csrf_login']) ||
    !hash_equals($_SESSION['csrf_login'], $token)
) {
    erroLogin('Solicitação inválida. Tente novamente.');
}

require __DIR__ . '/../config/conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!is_string($email) || !is_string($senha)) {
    erroLogin('Dados inválidos.');
}

$email = trim($email);

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $senha === '') {
    erroLogin('Informe um e-mail e uma senha válidos.');
}

try {

    $sql = "SELECT id, nome, email, senha_hash, tipo, ativo
            FROM usuarios
            WHERE email = ?
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $usuario = $stmt->fetch();

    if (
        !$usuario ||
        !$usuario['ativo'] ||
        !password_verify($senha, $usuario['senha_hash'])
    ) {
        erroLogin('E-mail ou senha incorretos.');
    }

    session_regenerate_id(true);

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    $_SESSION['usuario_tipo'] = $usuario['tipo'];

    unset($_SESSION['csrf_login']);

    switch ($usuario['tipo']) {

        case 'cliente':
            header('Location: ../index.php');
            break;

        case 'empresa':
            header('Location: ../empresa/index.php');
            break;

        case 'admin':
            header('Location: ../admin/index.php');
            break;

        default:
            $_SESSION = [];
            session_destroy();
            header('Location: ../login.php');
            break;

    }

    exit;

} catch (PDOException $erro) {

    error_log($erro->getMessage());

    erroLogin('Não foi possível realizar o login.');

}