<?php

session_start();

function erroCadastroEmpresa(string $mensagem): void
{
    $_SESSION['erro_cadastro_empresa'] = $mensagem;

    $camposPermitidos = [
        'nome',
        'email',
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'telefone',
        'email_comercial',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'descricao'
    ];

    $_SESSION['dados_cadastro_empresa'] = [];

    foreach ($camposPermitidos as $campo) {

        if (isset($_POST[$campo]) && is_string($_POST[$campo])) {

            $_SESSION['dados_cadastro_empresa'][$campo] =
                $_POST[$campo];

        }

    }

    header('Location: ../cadastro-empresa.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../cadastro-empresa.php');
    exit;
}

// Validar token de segurança

$token = $_POST['csrf'] ?? '';

if (
    !is_string($token) ||
    !isset($_SESSION['csrf_cadastro_empresa']) ||
    !hash_equals($_SESSION['csrf_cadastro_empresa'], $token)
) {
    erroCadastroEmpresa('Solicitação inválida.');
}

require __DIR__ . '/../config/conexao.php';

// Receber os dados do formulário

function campo(string $nome): string
{
    $valor = $_POST[$nome] ?? '';

    if (!is_string($valor)) {
        erroCadastroEmpresa('Dados inválidos.');
    }

    return trim($valor);
}

$nome = campo('nome');
$email = campo('email');

$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

$razaoSocial = campo('razao_social');
$nomeFantasia = campo('nome_fantasia');
$cnpj = strtoupper(campo('cnpj'));
$cnpj = preg_replace('/[^A-Z0-9]/', '', $cnpj);

$telefone = campo('telefone');
$emailComercial = campo('email_comercial');

$cep = preg_replace('/[\-\s]/', '', campo('cep'));
$rua = campo('rua');
$numero = campo('numero');
$complemento = campo('complemento');
$bairro = campo('bairro');
$cidade = campo('cidade');
$estado = strtoupper(campo('estado'));
$descricao = campo('descricao');

// Validar campos obrigatórios

$obrigatorios = [
    $nome,
    $email,
    $razaoSocial,
    $nomeFantasia,
    $cnpj,
    $telefone,
    $cep,
    $rua,
    $numero,
    $bairro,
    $cidade,
    $estado
];

foreach ($obrigatorios as $valor) {

    if ($valor === '') {
        erroCadastroEmpresa('Preencha todos os campos obrigatórios.');
    }

}

// Validar e-mails

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    erroCadastroEmpresa('E-mail de acesso inválido.');
}

if (
    $emailComercial !== '' &&
    !filter_var($emailComercial, FILTER_VALIDATE_EMAIL)
) {
    erroCadastroEmpresa('E-mail comercial inválido.');
}

// Validar senha

if (
    !is_string($senha) ||
    !is_string($confirmarSenha) ||
    strlen($senha) < 8 ||
    strlen($senha) > 72
) {
    erroCadastroEmpresa('Informe uma senha válida de pelo menos 8 bytes e no máximo 72.');
}

if ($senha !== $confirmarSenha) {
    erroCadastroEmpresa('As senhas não coincidem.');
}

// Validar formato do CNPJ

if (strlen($cnpj) !== 14 ||
    !preg_match('/^[A-Z0-9]{12}[0-9]{2}$/', $cnpj)) {
    erroCadastroEmpresa('O CNPJ deve possuir 14 caracteres válidos.');
}

// Validar CEP

if (!preg_match('/^[0-9]{8}$/', $cep)) {
    erroCadastroEmpresa('O CEP deve possuir 8 números.');
}

// Validar UF

$estados = [
    'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF',
    'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA',
    'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS',
    'RO', 'RR', 'SC', 'SP', 'SE', 'TO'
];

if (!in_array($estado, $estados, true)) {
    erroCadastroEmpresa('Informe uma UF válida.');
}

// Validar tamanho dos campos

$limites = [
    [$nome, 150],
    [$email, 150],
    [$razaoSocial, 150],
    [$nomeFantasia, 150],
    [$telefone, 20],
    [$emailComercial, 150],
    [$rua, 150],
    [$numero, 20],
    [$complemento, 100],
    [$bairro, 100],
    [$cidade, 100],
    [$descricao, 2000]
];

foreach ($limites as [$valor, $limite]) {

    if (mb_strlen($valor) > $limite) {
        erroCadastroEmpresa('Dados acima do tamanho permitido.');
    }

}

try {

    // Verificar e-mail duplicado

    $stmt = $pdo->prepare(
        'SELECT id FROM usuarios WHERE email = ?'
    );

    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        erroCadastroEmpresa('Este e-mail já está cadastrado.');
    }

    // Verificar CNPJ duplicado

    $stmt = $pdo->prepare(
        'SELECT id FROM empresas WHERE cnpj = ?'
    );

    $stmt->execute([$cnpj]);

    if ($stmt->fetch()) {
        erroCadastroEmpresa('Este CNPJ já está cadastrado.');
    }

    // Iniciar transação

    $pdo->beginTransaction();

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Registrar conta de usuário

    $sql = "INSERT INTO usuarios
            (nome, email, telefone, senha_hash, tipo)
            VALUES (?, ?, ?, ?, 'empresa')";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $email,
        $telefone,
        $senhaHash
    ]);

    $usuarioId = $pdo->lastInsertId();

    // Registrar dados da empresa

    $sql = "INSERT INTO empresas (
                usuario_id,
                razao_social,
                nome_fantasia,
                cnpj,
                descricao,
                telefone,
                email_comercial,
                cep,
                rua,
                numero,
                complemento,
                bairro,
                cidade,
                estado
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, ?
            )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $usuarioId,
        $razaoSocial,
        $nomeFantasia,
        $cnpj,
        $descricao,
        $telefone,
        $emailComercial,
        $cep,
        $rua,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $estado
    ]);

    // Confirmar os dois cadastros

    $pdo->commit();

unset($_SESSION['dados_cadastro_empresa']);
unset($_SESSION['csrf_cadastro_empresa']);

    $_SESSION['sucesso_cadastro'] =
        'Empresa cadastrada com sucesso!';

    header('Location: ../login.php');
    exit;

} catch (Throwable $erro) {

    // Desfazer operações em caso de falha

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    error_log($erro->getMessage());

    if (
        $erro instanceof PDOException &&
        ($erro->errorInfo[1] ?? null) == 1062
    ) {
        erroCadastroEmpresa('E-mail ou CNPJ já cadastrado.');
    }

    erroCadastroEmpresa('Não foi possível cadastrar a empresa.');

}