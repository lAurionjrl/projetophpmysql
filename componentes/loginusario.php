<?php
require_once 'config.php';

if(!empty($_POST['email'])&&!empty($_POST['senha'])) {

echo$_POST['email'];
echo$_POST['senha'];

}


?>

<?php

header('Content-Type: application/json; charset=utf-8');

if (
    empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest'
) {
    http_response_code(403);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Acesso não permitido.'
    ]);
    exit;
}

$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
$senha = $_POST['senha'] ?? '';

$login = trim((string) $login);
$senha = trim((string) $senha);

if ($login === '' || $senha === '') {
    http_response_code(400);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Preencha login e senha.'
    ]);
    exit;
}

$loginCorreto = 'admin@admin.com';
$senhaCorreta = '123456';

if ($login !== $loginCorreto || $senha !== $senhaCorreta) {
    http_response_code(401);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Login ou senha inválidos.'
    ]);
    exit;
}

session_regenerate_id(true);

$_SESSION['adminstatus'] = true;
$_SESSION['admin_nome'] = 'Administrador';
$_SESSION['admin_email'] = $login;
$_SESSION['id_admin'] = "123";

echo json_encode([
    'sucesso' => true,
    'mensagem' => 'Login realizado com sucesso.',
    'redirecionar' => 'admin/index.php'
]);
exit;
