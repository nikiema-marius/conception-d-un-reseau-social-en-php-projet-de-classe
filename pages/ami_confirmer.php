<?php
require '../include/db.php';
require '../include/Acceuil.php';


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

<div class='row'>
            <div class='col-2'>
            <ul class='nav flex-column'>
                  <li class='nav-item'>
                    <a class='nav-link' aria-current='page' href='invitations.php'>Invitations</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='amis.php'>Suggestions</a>
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
                            <table class='table'>
                                <h2>Tous Mes Amis</h2>

                                
                                <tbody>
                        <?php 


/*  requette pour exclu tous les amis 'SELECT user.id FROM user JOIN amis_confirmer ON user.id <> 4 AND user.id NOT IN (
    SELECT user.id FROM user JOIN amis_confirmer ON id_amis_avec = 4 AND id_amis_confir = user.id 
UNION SELECT user.id FROM user JOIN amis_confirmer ON id_amis_avec = user.id AND id_amis_confir = 4)' */



                        $id_confirm = (int)$_SESSION['auth']->id ;
                       // var_dump($id_confirm);
                        
                        $req = $pdo->prepare("SELECT id_amis_confir AS id_amis ,id_amis_avec AS amis_avec FROM amis_confirmer WHERE id_amis_avec = ?  OR id_amis_confir = ? ");
                        
                        $req->execute(array($id_confirm,$id_confirm));

                       
                while  ($donne = $req->fetch()){ 
                            $id_envoie = $donne->id_amis;
                          //  var_dump($id_envoie);
                            $id_recue = $donne->amis_avec;
                           // var_dump($id_recue);

                       
                            $rep = $pdo->query("SELECT * FROM user WHERE (id = $id_envoie OR id = $id_recue) AND id != $id_confirm  ");
                            while($donne = $rep->fetch()){
                                             
                                       echo " 
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
                                                <img src='../images/".$donne->images."' alt='' />
                                                ";
                                                
                                            }
                                            else{
                                                echo"
                                                <img src='../images/obama.jpg' alt='' />
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
                                                <a class='btn btn-primary' type='submit' name='accepter' href='autre_profil.php?id=".$donne->id." '>Voire profil </a>

                                              <a class='btn btn-danger' type='submit' name='refuser' href='supprimer_amis.php?id=".$donne->id." '>Supprimer </a>
                                            </div>
                                        </td>
                                    </tr>
                                    ";  
                                    
                                
                                    // var_dump($donne->id);
                            }

                            
                }
                               // var_dump($_SESSION['auth']->id);   ?>
                               
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


</body>
</html>