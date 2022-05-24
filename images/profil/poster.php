<?php/*
var_dump($_POST['images']);

*/?>



<?php
$url = $_POST['images'];
 
$path = pathinfo($url);
// vérification de l'extension pour ne pas télécharger n'importe quoi
$extension = isset($path['extension']) ? strtolower($path['extension']) : null;
if(in_array($extension, array('jpg','jpeg','png','gif')))
{
	$dossier = 'C:\xampp\htdocs\niki_facebook\images/';
        // ajoute un préfixe 'copy_'
	$nouveau_nom = 'copy_'.$path['basename'];
 
	// Ouvre un fichier pour lire un contenu existant
	$current = file_get_contents($url);
	// Ecrit dans la destination
	file_put_contents($dossier.$nouveau_nom, $current);
}

?>