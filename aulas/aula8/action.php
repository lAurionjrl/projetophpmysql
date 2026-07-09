<?php require_once dirname(__DIR__) . '/componentes/config.php'; ?>


<?php

if (!empty($_GET['nomeUser'])) {
    $nomeuser = filter_input(INPUT_GET, 'nomeUser', FILTER_SANITIZE_SPECIAL_CHARS);
    $_SESSION['nomeUser'] = $nomeuser;
}

?>

<?php

if (!empty($_GET['senhaUser'])) {
    $senhauser = filter_input(INPUT_GET, 'senhaUser', FILTER_SANITIZE_SPECIAL_CHARS);
    $_SESSION['senhaUser'] = encrypt_secure($senhauser, 'e');
}

?>

<?php
if (!empty($_POST['email_login']) && !empty($_POST['senha_login'])) {

    $emailuser = "jrlima@gmail.com";
    $senha = "HX4vjtlaYm1lgs5FVHvKPTeN6fJ5L4Rc0CKzsBpjs6KJuDNUrsOtcdPHrSU29QWElIf+5F78IpcTYurn0nOvbQ==";
    $nome = "junior lima";

    $senhadec = encrypt_secure($senha, 'd');

    echo $emaillogin = filter_input(INPUT_POST, 'email_login', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $senhalogin = $_POST['senha_login'];
    if ($emaillogin == $emailuser && $senhalogin == $senhadec) {

        $_SESSION['userstatus'] = true;
        $_SESSION['nomeadmin'] = $nome;
        $_SESSION['tempodeacesso'] = time();
        $_SESSION['dataacesso'] = $data;

        header('location:paineladmin.php');
        exit();
    } else {
        echo " e-mail:"
            . $emaillogin .
            " e senha: "
            . $senhalogin .
            " não conferem ";
        exit();
    }
}
?>

<?php
// código para retorno automático limpando o cache
// o haeder está expulsando da página
// exit ();está limpando o cache da página
header("Location: index.php");
exit();

?>