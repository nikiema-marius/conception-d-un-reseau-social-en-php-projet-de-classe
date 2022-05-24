
<?php require '../include/Acceuil.php' ?>



<?php
$id  =$_SESSION['auth']->id;
//var_dump($id);
//die;


$poster = '';
//var_dump($poster);

if(isset($_FILES['fichier_poster']))
{
  //  echo 'ok';
// $publications = $_POST['publication'];
// $auteur = $_SESSION['auth']->username;

$poster = $_FILES['fichier_poster']['name'];

$posterPath          = '../images/galerie/'.basename($poster);
$posterExtension     = pathinfo($posterPath, PATHINFO_EXTENSION);

$isSuccess         = true ;
$isUploadSuccess   = false;

if (empty($poster)) {
    $posterError ='Ce champ ne peut être vide' ;
        
    $isSuccess = false ;
}else{

    $isUploadSuccess = true ; 


    // verification de l extension de l image
    if ($posterExtension != 'jpg' && $posterExtension != 'png' && $posterExtension != 'jpeg' && $posterExtension != 'gif'  && $posterExtension != 'mp4'  && $posterExtension != 'mp3' ) 
    {
        $posterError = ' Les fichiers autorisés sont : .jpg , .png , .jpeg , .gif , .mp4, .mp3' ;
        $isUploadSuccess = false ;
    }

    // voir si l image n existe pas deja 
    
    // verification de la taille pas > 500 KB
    


    if ($isUploadSuccess) 
    {    
       
        // prendre le chemin temporaire et mettre dans le bon chemin 
        if (!move_uploaded_file($_FILES['fichier_poster']['tmp_name'], $posterPath ) ) 
        {
            $posterError = "il y a une erreur lors de l' upload ";
            $isUploadSuccess = false ;
        }
    }
}

if ($isSuccess && $isUploadSuccess ) 
{  
  
    $req = $pdo->prepare('INSERT INTO galerie SET id_pers = ? , image =? '); // une requete prepare selectionnant l'user dans notre base de donnee

     $req->execute(array($id,$poster));
//echo $auteur;
}


//echo $publications;

}


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
   <link rel="stylesheet" href="../css/b.min.css">
   <link rel="stylesheet" href="../css/photo.css">
    <title>Document</title>
</head>
<body>
    


<form action='photo.php' method='POST' enctype='multipart/form-data'>
        <div class='panel panel-default'>
            <div class='panel-footer'>
                <div class='btn-group'>
                    <input type='file' class='fichier' id ='fichier_poster' name='fichier_poster'>
                    <div ><i class='bx bx-images bx-lg'></i></div>
                </div>   
            </div>  
        </div>
        <div class='pull-right'>
            <button type='submit' class='btn btn-success'>Poster image</button>
        </div> 
</form>




<div class="whos-speaking-area speakers pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text mb50">
                        <h2>GALERIE DE PHOTO </h2>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /.row  end-->
        <div class='row mb50'>
        <?php
        
        $rep = $pdo->query('SELECT  image,id_pers FROM galerie');

        while($donne = $rep->fetch()){
            if($donne->id_pers == $id ){

            
        echo " 
           
       


    
            <div class='col-md-4' >
                <div class='speakers xs-mb30'>
                    <div class='spk-img'>
                        <img class='img-fluid' src='../images/galerie/$donne->image' alt='trainer-img' style='width: 800px' />
                       
                    </div>
                </div>
            </div>

            " ;
        }
    }


        ?>

       
           
        </div> 
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>


</body>
</html>