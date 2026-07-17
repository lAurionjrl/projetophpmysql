<?php
require_once 'config.php';
require_once 'conexao.php';

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

$login = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
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

$con = config::connect();  //abre a conexão
$sql = "SELECT  id, email, nome, senha, nivel 
        FROM usuarios WHERE email ='$login'";
$stmt = $con->query($sql);
$dados = $stmt->fetch(PDO::FETCH_ASSOC);

$loginCorreto = $dados['email']??'0';
$senhaCorreta = $dados['senha']??'0';

$decs = encrypt_secure($senhaCorreta,'d');




if ($login !== $loginCorreto || $decs !== $senha ) {
    http_response_code(401);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Login ou senha inválidos.1.'.$login.'2.'.$senhaCorreta.''
    ]);
    exit;
}

session_regenerate_id(true);

$_SESSION['adminstatus'] = true;
$_SESSION['admin_nome'] = $dados['nome'];
$_SESSION['admin_nivel'] = $dados['nivel'];
$_SESSION['admin_email'] = $login;
$_SESSION['id_admin'] = encrypt_secure($dados['id'],'e');

echo json_encode([
    'sucesso' => true,
    'mensagem' => 'Login realizado com sucesso.',
    'redirecionar' => 'admin/index.php'
]);
exit;
