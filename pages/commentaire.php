<?php require '../include/Acceuil.php' ;?>
<?php require '../include/debug.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../boxicons/css/boxicons.min.css'>
    <link rel='stylesheet' href='../css/bootstrap.css'>
    <link rel='stylesheet' href='../css/b.min.css'>
    <link rel='stylesheet' href='../css/commentaire.css'>
    
 

    <title>Document</title>
</head>
<body>




<?php
/*----------------------------traitement des commentaires-----------------------------  */

$id_connect = $_SESSION['auth']->id;
$id_article = $_GET['id_article'];
if(!empty($_GET['id_article'])){
    $id_article = $_GET['id_article'];
   // $id_article = $_GET['envoyer'];
   if(!empty($_GET['commentaire'])){

 
    $commenataire = $_GET['commentaire'];

    $req = $pdo->prepare('INSERT INTO commentaire SET id_article = ? , id_personne =?, commentaire=?, date_commentaire=NOW() '); // une requete prepare selectionnant l'user dans notre base de donnee

    $req->execute(array($id_article,$id_connect,$commenataire));
    }
}



?> 




<div class='post'>
<?php echo "   <form action='commentaire.php?id_article=".$id_article."' method='GET'> " ?>
                <div class='input-group'> 
                <textarea class='form-control me-2' name='commentaire'  placeholder='Votre comenataire'></textarea>
                    <span class='input-group-addon'>
                     <?php echo "<button  name='id_article'  value='$id_article'><i class='bx bxl-telegram'></i></button> " ?>
                    </span>
                </div>
        </form>
           
        <div class="container">
            <div class="row">



            <?php 
            $rep = $pdo->query('SELECT  id_personne,id_article,commentaire,date_commentaire FROM commentaire'); 
            
            while($donne = $rep->fetch()  ){
               $id_connect =  $donne->id_personne;
               // die;
               
                $req = $pdo->query("SELECT  nom,prenom,images FROM user WHERE id = $id_connect");
                while($don = $req->fetch() ){
                   /// var_dump($don);
                    //  die;

                    if ($id_article == $donne->id_article) {
                        
                  
                    echo "
                            <div class='col-md-8'>
                                    <div class='media g-mb-30 media-comment'>
                                        <img class='d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15' src='../images/$don->images' alt='Image Description'>
                                        <div class='media-body u-shadow-v18 g-bg-secondary g-pa-30'>
                                        <div class='g-mb-15'>
                                            <h5 >Nom : $don->nom $don->prenom</h5>
                                            
                                            <h5 >".TimeToJourJ($donne->date_commentaire )."</h5>
                                        </div>
                                    
                                        <p>
                                        $donne->commentaire
                                        </p>
                                    
                                        
                                        </div>
                                    </div>
                                </div>
                    
                    "; 
                    }
                }
        }
            ?>

                
        </div>
    </div>
</div>

 

</body>
</html>

