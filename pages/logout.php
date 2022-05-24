<?php 
session_start();
setcookie('password',NULL,-1);
setcookie('email',NULL,-1);
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous êtes maitenant déconnecté";
header('location: ../pages/index.php');
session_abort();
?>