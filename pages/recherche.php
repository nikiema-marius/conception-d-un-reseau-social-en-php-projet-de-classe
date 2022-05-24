<?php require '../include/Acceuil.php';
require '../include/db.php';
require '../include/debug.php';
?>

<nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <form class="d-flex" action='recherche.php' method="GET" >
                    <input class="form-control me-2" type="search" placeholder="Rechercher quelqu'un" aria-label="Search" name="recherche"></input>
                    <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>
</nav>




<?php/********************************************traitement de la barre de recherche*********************************************/   ?>

<?php








if (!empty($_GET['recherche'])) {
  




    if (!empty($_GET['recherche']) && $_GET['recherche'] !=$_SESSION['auth']->nom && $_GET['recherche'] !=$_SESSION['auth']->prenom && $_GET['recherche'] !=$_SESSION['auth']->username) {

        $recherche = $_GET['recherche'];
      
        $req = $pdo->prepare("SELECT id , nom , prenom, images,ville ,annee,mois,jour FROM user WHERE (nom LIKE :recherche OR prenom LIKE  :recherche OR username LIKE :recherche)");
        $req->execute(['recherche'=> "%".$recherche."%"]);
        $searc = $req->fetchAll();
       // var_dump($search);
        //die;
        foreach($searc as $search){

            $rep = $pdo->query("SELECT COUNT(id) ,id_amis_confir,id_amis_avec FROM amis_confirmer WHERE $search->id = id_amis_confir OR  $search->id = id_amis_avec");
            $amis = $rep->fetch();
            //die;
            if($search && $search->id != $_SESSION['auth']->id ){
                if($amis->id_amis_confir == $search->id || $amis->id_amis_avec == $search->id ){
   
                   echo " 
                   <tr class='inner-box'>
                   
                   <td>
                       <div class='event-img'> ";
                       if($search->images!= NULL){
                           echo"
                           <img src='../images/".$search->images."' alt='' />
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
                           <h3><a href='#'>".$search->nom. ""." ".$search->prenom."</a></h3>
                           <div class='meta'>
                               <div class='organizers'>
                                   <p>Habite à  ".$search->ville."</p>
                               </div>
                           </div>
                       </div>
                   </td>
                   <td>
                       
                   </td>
                   <td>
                       <div class='primary-btn'>
                           <a class='btn btn-primary' type='submit' name='accepter' href='autre_profil.php?id=".$search->id." '>Voire profil </a>
   
                           <a class='btn btn-danger' type='submit' name='refuser' href='supprimer_amis.php?id=".$search->id." '>Supprimer </a>
                       </div>
                   </td>
                   </tr>
           ";  
            
                 }
                 else{ 
      
                    echo " 
                    <tr class='inner-box'>
                    <td>
                        <div class='event-img'> ";
                        if($search->images!= NULL){
                            echo"
                            <img src='../images/".$search->images."' alt='photo' />
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
                            <h3><a href='#'>".$search->nom. ""." ".$search->prenom."</a></h3>
                            <div class='meta'>
                                <div class='organizers'>
                                    <p>Habite à  ".$search->ville."</p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        <div class='primary-btn'>
                        <a class='btn btn-primary' href='verif_amis.php?id=".$search->id."'>Ajouter</a>
                        <a class='btn btn-primary' type='submit' name='accepter' href='autre_profil.php?id=".$search->id." '>Voire profil </a>
                        </div>
                    </td>
                    </tr>
                    ";  


            }


}

        }
      
        
        
            //     else{
            //     echo "<p class ='alert alert-danger'> Recherche de ".$_GET['recherche']." Introuvable </p>";
            //   }
            //     //echo 'salut';


              
      }

}else{
    echo "<p class ='alert alert-danger'> Vous n'avez rien entrer dans la barre de recherche </p>";
}






?>



<?php/********************************************traitement de la barre de recherche*********************************************/   ?>