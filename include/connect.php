<?php
$user_id = $_GET['id'];
require '../include/db.php';
$req = $pdo->prepare('SELECT confirmed_at FROM user WHERE id = ?');
// une requete prepare selectionnant l'user dans notre base de donnee
    $req->execute([$user_id]); // l'execution de notre requete
    $user = $req->fetch(); // retourne la premiere ligne selectionné


   // $nom = $pdo->prepare('SELECT username FROM user WHERE id = ?') ;
   // $nom->execute([$user_id]);
   // $use = $nom->fetch();
    if($user){
        session_start();
        $pdo->prepare('UPDATE user SET confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
        $_SESSION['auth'] = $user;
        header('location: ../pages/verif.php');
    }else{
      $_SESSION['flash']['danger'] = "vous n\'est pas connecté alors veuillez vous connectez svp";
      header('Location:../pages/index.php');
    }

?>