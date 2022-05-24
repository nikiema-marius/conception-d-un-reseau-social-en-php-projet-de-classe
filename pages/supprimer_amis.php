<?php 
require '../include/db.php';
session_start();
$id_p= $_SESSION['auth']->id;
$id = $_GET['id'];
var_dump($_SESSION['auth']->id);
var_dump($id);

$pdo->query("DELETE FROM  `amis_confirmer` WHERE (id_amis_confir , id_amis_avec)=($id,$id_p) OR (id_amis_confir , id_amis_avec) = ($id_p,$id) ");


header('Location:ami_confirmer.php')



?>