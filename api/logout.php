<?php

require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

$token = $_POST['csrf'] ?? '';

if (
    !is_string($token) ||
    !isset($_SESSION['csrf_logout']) ||
    !hash_equals($_SESSION['csrf_logout'], $token)
) {
    http_response_code(403);
    exit('Solicitação inválida.');
}

// Limpar os dados da sessão

$_SESSION = [];

// Remover o cookie da sessão

if (ini_get('session.use_cookies')) {

    $parametros = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $parametros['path'],
        $parametros['domain'],
        $parametros['secure'],
        $parametros['httponly']
    );

}

// Encerrar a sessão

session_destroy();

// Retornar para a página inicial

header('Location: ../index.php');
exit;