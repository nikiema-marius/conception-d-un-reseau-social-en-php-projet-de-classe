<?php require '../include/Acceuil.php';
require '../include/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../boxicons/css/boxicons.min.css'>
  <link rel='stylesheet' href='../css/bootstrap.css'>
  <link rel='stylesheet' href='../css/amis.css'>
  <link rel='stylesheet' href='../css/font-awesome.min.css'>
    <title>Document</title>
</head>
<body>
    
<?php    
       
       
        $id_verif = $_SESSION['auth']->id ;
          if(isset($_GET) && !empty($_GET))  
          { 
                if($_GET['statut'] == "accepter")
                 {
                    $id = $_GET['id_a'];
                   $reponse =  $pdo->prepare("UPDATE amis SET staut_amis = true WHERE id_amis = ? AND id_moi = ?"); 
                   $reponse->execute(array($id_verif,$id));
                   
                } 
                elseif ($_GET['statut'] == "refuser") 
                {   
                  
                    $id = $_GET['id_a'];
                    $reponse = $pdo->prepare("DELETE FROM amis WHERE id_amis = ? AND id_moi = ?");
                    $reponse->execute(array($id_verif,$id));
                } 
            }      
     
 ?>


<?php 
$statut = 1;



$req = $pdo->query("SELECT id_amis,id_moi,nom_amis,prenom_amis FROM amis WHERE staut_amis = true"); // une requete prepare selectionnant l'user dans notre base de donnee

while($donne = $req->fetch()){ 

    $reponse =$pdo->prepare("INSERT INTO amis_confirmer SET id_amis_confir = ? , id_amis_avec = ? , nom_amis_confir = ? , prenom_amis_confir = ? ");
    $reponse->execute(array($donne->id_amis , $donne->id_moi , $donne->nom_amis, $donne->prenom_amis));
    //var_dump($donne);
}

$pdo->query("DELETE FROM `amis` WHERE (amis.staut_amis = true)");
$pdo->query("DELETE FROM `amis` WHERE (amis.staut_amis = false)");

?>



<div class='row'>
            <div class='col-2'>
            <ul class='nav flex-column'>
                  <li class='nav-item'>
                    <a class='nav-link' href='amis.php'>Suggestions</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='ami_confirmer.php'>Tous les amis</a>
                  </li>
                </ul>
            </div> 
    </div>

<div class='event-schedule-area-two bg-color pad100'>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                
                <div class='tab-content' id='myTabContent'>
                    <div class='tab-pane fade active show' id='home' role='tabpanel'>
                        <div class='table-responsive'>
                           
                        <?php  


                                    $rep = $pdo->query('SELECT nom, prenom, ville , jour,mois,annee ,images ,id_amis, id_moi  FROM user JOIN amis ON user.id = amis.id_moi');
                                    while($donne = $rep->fetch()){
                                        
                                        if($donne->id_amis == $_SESSION['auth']->id ){
                                       echo " 
                                       <table class='table'>
                                       <h2>La liste des personnes qui vous ont envoyé une Invitations</h2>
       
                                       
                                       <tbody>
                                      <tr class='inner-box'>
                                        <th scope='row'>
                                            <div class='event-date'>
                                                <span>".$donne->jour."</span>
                                                <p>".$donne->mois."</p>
                                                <p>".$donne->annee."</p>
                                            </div>
                                        </th>
                                        <td>
                                            <div class='event-img'> ";
                                            if($donne->images!=NULL){
                                                echo"
                                                <img src='../images/".$donne->images."' alt='photo' />
                                                ";
                                                
                                            }
                                            else{
                                                echo"
                                                <img src='../images/obama.jpg' alt='photo' />
                                                ";
                                            }
                                                
                                                echo " 
                                            </div>
                                        </td>
                                        <td>
                                            <div class='event-wrap'>
                                                <h3><a href='#'>".$donne->nom. ""." ".$donne->prenom."</a></h3>
                                                <div class='meta'>
                                                    <div class='organizers'>
                                                        <p>Habite à  ".$donne->ville."</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <div class='primary-btn'>
                                                <a class='btn btn-primary' type='submit' name='accepter' href='invitations.php?statut=accepter&id_a=".$donne->id_moi."'>Accepter </a>
                                                <a class='btn btn-danger' type='submit' name='refuser' href='invitations.php?statut=refuser&id_a=".$donne->id_moi."' >refuser </a>
                                            </div>
                                        </td>
                                    </tr>
                                    ";  
                                    
                                }
                               
                                    // var_dump($donne->id);
                                }
                               // var_dump($_SESSION['auth']->id);   ?>
                                </tbody>
                            </table>

                            
                            
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
</div>


</div>


 <!-- requete SQL sur la table ami et la table amis_cofirmer pour les amis qui sont deja confirmés-->



</body>
</html>