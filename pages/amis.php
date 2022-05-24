<?php require '../include/Acceuil.php' ?>
<?php require '../include/db.php' ?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
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
                  <!-- <li class='nav-item'>
                    <a class='nav-link' href='#'>Suggestions</a>
                  </li> -->
                  <li class='nav-item'>
                  <?php echo "<a class='nav-link' href='ami_confirmer.php?' >Tous les amis</a>" ?>
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
                                <h2>Suggestions</h2>

                                
                                <tbody>
                        <?php  
                        $id_confirm =(int)$_SESSION['auth']->id;

                                    //  $rep = $pdo->query("SELECT user.id FROM user JOIN amis_confirmer ON user.id <> $id_confirm AND user.id NOT IN (
                                    //      SELECT user.id FROM user JOIN amis_confirmer ON id_amis_avec = $id_confirm AND id_amis_confir = user.id 
                                    //     UNION SELECT user.id FROM user JOIN amis_confirmer ON id_amis_avec = user.id AND id_amis_confir = $id_confirm )");
                                        
                                      

                                    $rep = $pdo->query("SELECT user.id FROM user WHERE user.id <> $id_confirm AND user.id NOT IN (
                                     SELECT user.id FROM user JOIN amis_confirmer WHERE (id_amis_avec,id_amis_confir) = ($id_confirm ,user.id) OR (id_amis_avec,id_amis_confir) = (user.id,$id_confirm ))");
                                    // foreach ($rep as $requete){
                                    //     var_dump($requete->id);
                                        
                                    // }die;
                                   
                                   
                                  
                                    
                                            while($donne = $rep->fetch()){
                                                   
                                                       $affiche = $pdo->query("SELECT * FROM user WHERE id = $donne->id " );
                                                       while($don = $affiche->fetch()){ 
                                                         
                                                        echo " 
                                                        <tr class='inner-box'>
                                                            <th scope='row'>
                                                                <div class='event-date'>
                                                                    <span>".$don->jour."</span>
                                                                    <p>".$don->mois."</p>
                                                                    <p>".$don->annee."</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class='event-img'> ";
                                                                if($don->images!=NULL){
                                                                    echo"
                                                                    <img src='../images/".$don->images."' alt='' />
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
                                                                    <h3><a href='#'>".$don->nom. ""." ".$don->prenom."</a></h3>
                                                                    <div class='meta'>
                                                                        <div class='organizers'>
                                                                            <p>Habite à  ".$don->ville."</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                
                                                            </td>
                                                            <td>
                                                                <div class='primary-btn'>
                                                                    <a class='btn btn-primary' href='verif_amis.php?id=".$don->id."'>Ajouter</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        ";

                                                    
                                            
                                                // var_dump($donne->id);
                                            
                                            }
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



</body>
</html>