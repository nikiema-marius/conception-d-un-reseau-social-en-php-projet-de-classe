<?php 
require '../include/db.php';
session_start();
$id = $_SESSION['auth']->id;
if(!empty($_GET)){ 
$id_mur = $_GET['id'];
$contenu = $_GET['mur'];
var_dump($_SESSION['auth']->id);
var_dump($id_mur);

$rep = $pdo->prepare(" INSERT INTO mon_mur SET mon_id =? , per_id=? , le_mur = ?, date=NOW()");
$requete = $rep->execute(array($id_mur,$id,$contenu));
header('Location:autre_profil.php?id='.$id_mur);

}else{
    header('Location:profil.php');
}

?>