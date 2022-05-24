<?php
//var_dump($_GET['id']);
//echo 'votre id est '.$_GET['id'];
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ajouter une photo de profil a votre compte</h1>
    <?php   echo  " <form action='verif_photo.php?id=".$id."' method='POST' enctype='multipart/form-data'>" ?>

        <div class="form-group">
            <label for="image">Sélectionner une image :</label>
            <input type="file" id="image" name="image" >
            
        </div>

        <br>
        <div class="forms-actions">
            <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-pencil"></span>Ajouter</button>
            <a href="index.php" class="btn btn-primary"> <span class=" glyphicon glyphicon-arrow-left"></span> Retour</a>
        </div>

    </form>

</body>
</html>