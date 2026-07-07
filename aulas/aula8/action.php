<?php require_once dirname(__DIR__). '/componentes/config.php';?>


<?php

if(!empty($_GET['nomeUser'])){
$nomeuser = filter_input(INPUT_GET,'nomeUser',FILTER_SANITIZE_SPECIAL_CHARS); 
$_SESSION ['nomeUser'] = $nomeuser ;
    
}

?>

<?php

if(!empty($_GET['senhaUser'])){
$senhauser = filter_input(INPUT_GET,'senhaUser',FILTER_SANITIZE_SPECIAL_CHARS); 
$_SESSION ['senhaUser'] = encrypt_secure($senhauser,'e');     
     
    
}

?>

<?php
if(!empty($_POST['email_login'])&&!empty($_POST['email_login'])) {

 $email = "jrlima@gmail.com"; 
 $senha = "xAslEz7eg+AxmNpWKQ1yZfB+8DlEy6TGEvt+q0p07ghPvuxfNbIHdHVTi+tEtlhSgAGBKAnigzUHelB5tjfRQA==";
 
$emaillogin = filter_input(INPUT_POST,'email_login',FILTER_SANITIZE_SPECIAL_CHARS); 
$senhalogin = filter_input(INPUT_POST,'senha_login',FILTER_SANITIZE_SPECIAL_CHARS); 
}
 ?>

<?php
// código para retorno automático limpando o cache
// o haeder está expulsando da página
// exit ();está limpando o cache da página
header("Location: index.php");
exit();

?>