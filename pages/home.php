<?php require '../include/Acceuil.php';
require '../include/db.php';
require '../include/debug.php';
?>



<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel='stylesheet' href='../boxicons/css/boxicons.min.css'>
  <link rel='stylesheet' href='../css/bootstrap.css'>
  <link rel='stylesheet' href='../css/bootstrap.min.css'>
  <link rel='stylesheet' href='../css/b.min.css'>
  <link rel='stylesheet' href='../css/acceuil.css'>
  <title>FASO CHAT</title>
</head>
<body>





<div class="recherche">
<a href="recherche.php" ><button class="btn btn-primary" type="submit">Rechercher quelqu'un</button></a>
</div>



    <div class='container'>
         <div class='row activity'>
                    <div class='col-md-12'>
                 <form action='' method='POST' enctype='multipart/form-data'>
                            <div class='panel panel-default'>
                                <div class='panel-body'>
                                <textarea class='form-control' name='publication' rows='4' placeholder='Ecrire quelque chose a publier'></textarea>
                                </div>
                                <div class='panel-footer'>
                                    <div class='btn-group'>
                                        <input type='file' class='fichier' id ='fichier_poster' name='fichier_poster'>
                                        <div ><i class='bx bx-images bx-lg'></i></div>

                                        <div ><i class='bx bxs-video bx-lg' ></i></div>
                                    </div>   
                                </div>  
                            </div>
                            <div class='pull-right'>
                             <button type='submit' class='btn btn-success'>publier</button>
                         </div> 
                 </form><!--------------------------------------------barre de recherche----------------------------------------------------->
            </div> 
        </div> 






<!--------------------------------------------recuperation des publicatons----------------------------------------------------->


<?php // echo $_SESSION['auth']->username  ;


//echo 'Filename: ' . $_FILES['fichier_poster']['name'].'<br>';


$poster = '';
if(!empty($_POST))
{
$publications = $_POST['publication'];
$auteur = $_SESSION['auth']->username;

$poster = $_FILES['fichier_poster']['name'];
$posterPath          = '../images/publications/'.basename($poster);
$posterExtension     = pathinfo($posterPath, PATHINFO_EXTENSION);

$isSuccess         = true ;
$isUploadSuccess   = false;

if (empty($poster)) {
    $posterError ='Ce champ ne peut être vide' ;
       $req = $pdo->prepare('INSERT INTO publication SET nom_auteur = ? , contenue = ?, date =NOW() '); // une requete prepare selectionnant l'user dans notre base de donnee
       $req->execute(array($auteur,$publications));
     echo 'Ce champ ne peut être vide' ;
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
  
    $req = $pdo->prepare('INSERT INTO publication SET nom_auteur = ? , contenue = ?, illustration = ? , date =NOW() '); // une requete prepare selectionnant l'user dans notre base de donnee

     $req->execute(array($auteur,$publications,$poster));
//echo $auteur;
}


//echo $publications;

}





//infin de l'enregistrement de de la publication


?>




<!--------------------------------------------fin recuperation des publicatons----------------------------------------------------->





<?php //save_id();  ?>



      <div class='row '>
         <div class='col-lg-4 col-8 layout-spacing'>
             <div class='statbox widget box box-shadow'>
                <div class='widget-header'>
                    <div class='row'>
                        <div class='col-xl-12 col-md-12 col-sm-12 col-12'>
                            <h4 class='pb-0'>Presonnes Connectées</h4>
                        </div>
                    </div>
                </div>

                <?php
                $id_confirm = (int)$_SESSION['auth']->id ;
                // var_dump($id_confirm);

                $req = $pdo->prepare("SELECT id_amis_confir AS id_amis ,id_amis_avec AS amis_avec FROM amis_confirmer WHERE id_amis_avec = ?  OR id_amis_confir = ? ");

                $req->execute(array($id_confirm,$id_confirm));


                while  ($donne = $req->fetch()){ 
                $id_envoie = $donne->id_amis;
                //  var_dump($id_envoie);
                $id_recue = $donne->amis_avec;
                // var_dump($id_recue);


                $rep = $pdo->query("SELECT * FROM user WHERE (id = $id_envoie OR id = $id_recue) AND id != $id_confirm ");
                while($donne = $rep->fetch()){

                    if ($donne->images != NULL) {
                        echo " 
                    
                        <div class='widget-content widget-content-area'>
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12'>
                                <div id='content_2' class='tabcontent'> 
                                    <div class='story-container-2'>
                                        <a class='single-story' href='message.php?id_per=".$donne->id."'>              
                                            <div class='story-dp'>
                                                <img src='../images/$donne->images'>
                                            </div>
                                            <div class='story-author'>
                                                    <p class='name'>".$donne->nom."</p>
                                                    <p class='time'>Vous etre amis</p>
                                                </div> 
                                          </a>      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                        ";
                    }else{

                        echo " 
                    
                        <div class='widget-content widget-content-area'>
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12'>
                                <div id='content_2' class='tabcontent'> 
                                    <div class='story-container-2'>
                                        <a class='single-story' href='message.php?id_per=".$donne->id."'>              
                                            <div class='story-dp'>
                                                <img src='../images/obama.jpg'>
                                            </div>
                                            <div class='story-author'>
                                                    <p class='name'>".$donne->nom."</p>
                                                    <p class='time'>Vous etre amis</p>
                                                </div> 
                                          </a>      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                        ";
                    }
                   


                    }
                  
             }


                ?>
            </div>
        </div><!--------------------------------------------personne connectées----------------------------------------------------->



        <div class='col-8'>


        <?php
        $rep = $pdo->query('SELECT  * FROM user, publication WHERE user.username = publication.nom_auteur ORDER BY publication.id DESC ');
        while($donne = $rep->fetch()){
        echo " 
                        
       
                        
                    <div class='panel panel-white post panel-shadow'>
                        <div class='post-heading'>
                            <div class='pull-left image'>
                            <img src='../images/$donne->images' class='img-circle avatar' alt='user profile image' >
                            </div>
                            <div class='pull-left meta'>
                                <div class='title h5'>
                                <a href='#'><b>$donne->username</b></a>
                                    
                                </div>
                               <h6 class='text-muted time'>$donne->date</h6>
                            </div>
                        </div> 
                        <div class='post-description'> ";
                                
                        if($donne->illustration != NULL)
                        {
                            echo" <img src='../images/publications/$donne->illustration' alt='' style='width: 700px '> ";

                            echo " 
                            <p>$donne->contenue</p>
                            <div class='stats'>
                                <a href='#' class='btn btn-default stat-item'>
                                    <i i class='bx bxs-like'></i>2
                                </a>
                                <a href='commentaire.php?id_article=".$donne->id."' class='btn btn-default stat-item'>
                                    <i class='bx bxs-comment'></i>12
                                </a>
                            </div>
                        </div>
                       
                    </div>" ;
                 }else{
                           
                           echo " 
                            <p>$donne->contenue</p>
                            <div class='stats'>
                                <a href='#' class='btn btn-default stat-item'>
                                    <i i class='bx bxs-like'></i>2
                                </a>
                                <a href='commentaire.php?id_article=".$donne->id."' class='btn btn-default stat-item'>
                                    <i class='bx bxs-comment'></i>12
                                </a>
                            </div>
                        </div>
                        
                    </div> ";
                }

                      ; }
                $rep->closeCursor()
                    
                    ?>

<!-------------------------------------------- publication 2----------------------------------------------------->


                   
        </div><!--------------------------------------------corps de publications----------------------------------------------------->
    </div>
                                

</div>  

</div>



</body>
</html>