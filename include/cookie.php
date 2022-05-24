<?php
if(!isset($_SESSION['id']) AND isset($_COOKIE['email'],$_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password'])) {
   $requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
   $requser->execute(array($_COOKIE['email'], $_COOKIE['password']));
   $userexist = $requser->rowCount();
   if($userexist == 1)
   {
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['username'] = $userinfo['pseudo'];
      $_SESSION['email'] = $userinfo['mail'];
      header("Location: ../pages/home.php?id=".$_SESSION['id']);
   }
}
?>