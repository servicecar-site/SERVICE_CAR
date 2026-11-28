<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function estaLogado(): bool
{
    return isset($_SESSION['usuario_id']);
}

function exigirLogin(): void
{
    if (!estaLogado()) {
        header('Location: /SERVICE_CAR/login.php');
        exit;
    }   
}

function exigirTipo(string $tipo): void
{
    exigirLogin();

    if (($_SESSION['usuario_tipo'] ?? '') !== $tipo) {
        http_response_code(403);
        exit('Acesso não autorizado.');
    }
}