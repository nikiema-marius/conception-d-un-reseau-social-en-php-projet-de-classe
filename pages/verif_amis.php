

<?php
session_start();
 require '../include/db.php' ;
$id_ajouter = $_GET['id'];

$re = $pdo->prepare('SELECT nom, prenom ,username FROM user WHERE id = ?'); // une requete prepare selectionnant l'user dans notre base de donnee

$re->execute(array($id_ajouter));
$amis = $re->fetch();

//var_dump($im);
//var_dump($_SESSION['auth']->id);

$req = $pdo -> prepare("INSERT INTO amis SET id_amis = ?, id_moi = ?, nom_amis = ? , prenom_amis = ?, username_amis= ? ");
   $req->execute(array($id_ajouter,$_SESSION['auth']->id,$amis->nom,$amis->prenom,$amis->username));
    header('Location:amis.php');

?>