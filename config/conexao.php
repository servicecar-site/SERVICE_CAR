<?php

// SERVICE CAR - CONEXÃO COM O BANCO

$arquivo = __DIR__ . '/credenciais.php';

if (!is_file($arquivo)) {
    http_response_code(500);
    exit('Configuração do banco não encontrada.');
}

$config = require $arquivo;

$dsn = "mysql:host={$config['servidor']};"
     . "port={$config['porta']};"
     . "dbname={$config['banco']};"
     . "charset={$config['charset']}";

$opcoes = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {

    $pdo = new PDO(
        $dsn,
        $config['usuario'],
        $config['senha'],
        $opcoes
    );

} catch (PDOException $erro) {

    error_log($erro->getMessage());
    http_response_code(500);
    exit('Erro ao conectar com o banco de dados.');

}