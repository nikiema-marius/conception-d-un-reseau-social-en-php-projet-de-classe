<?php require '../include/Acceuil.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/profil.css">
  <title>Document</title>
</head>
<body>
    




<?php

echo 'votre id est '.$_GET['id'];
$id = $_GET['id'];



if (!empty($_POST)){

    $error = array();

    require_once '../include/db.php';//inclu une seul fois l'acces a la base de donnee

    if(empty($_POST['username']) || !preg_match('/^[a-z0-9_]+$/' , $_POST['username'])){
        $error['username'] = "Vous aviez pas entrer un Nom Valide (alphanumerique)";
    }
    // pour que un utilisateur cree un et un seul compte
   // debuger($error);

   if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $error['email'] = 'votre email n est pas valide';
   } 



   if(empty($error)){
    $req = $pdo -> prepare("UPDATE user SET nom = ?, prenom = ?, username = ?, email = ?, ville =?, pays = ?, jour = ?, mois = ?, annee = ?, numero = ? WHERE id=$id "); 
    $req->execute(array($_POST['nom'] , $_POST['prenom'],$_POST['username'],$_POST['email'],$_POST['ville'],$_POST['pays'],$_POST['jour'],$_POST['mois'],$_POST['annee'] , $_POST['numero'] ));
  // $user_id = $pdo->lastInsertId();// revoie l'id
   //var_dump($user_id);
  //  session_start();
    //$_SESSION['auth'] = $user;
    echo "vos imformations ont été bien enregistré Veilliez vous connectez avec vos identifiants";
    echo "<script type='text/javascript'>document.location.replace('../include/Acceuil.php');</script>";


   }
}

?>


    <h2  style="background: red; text-align: center;" >Rejoinez la Team Faso Chat</h2>

        <div class="container">
                <h1>modifier vos informations  </h1>
                <?php
                
                if(!empty($error)):?>
                <div class="alert alert-danger">
                    <p>Vous n'avez pas rempli le formulaire correctement </p>
                    <ul>
                        <?php foreach($error as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            
                <form action="" method="POST" >


                    <img src="../fonts/icons/person-plus.svg" alt="Bootstrap" width="50" height="80" style="margin-left: 300px; " >

                    <div class="form-group" >
                                <div class="col-md-4 mb-2" >
                                    <label for="nom">Entrez votre nom</label>

                                    <input type="text" class="form-control" id="nom" placeholder="Nikiema" name="nom" />
                                    <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>

                                </div>


                                <div class="col-md-4 mb-4" >
                                    <label for="nom">Entrez votre Prenom</label>
                                    <span class="input-group-addon"> <i class="fa fa-prenom"></i></span>
                                    <input type="text" class="form-control" id="Prenom" placeholder="Marius" name="prenom" required />
                                   

                                </div>



                                <div class="col-md-4 mb-4" >
                                    <label for="nom">Entrez votre Pseudo</label>
                                    <input type="text" class="form-control" id="username" placeholder="mario niki" name="username"  required />
                                 

                                </div>


                                <div class="col-md-4 mb-4" >
                                    <label for="email">Entrez votre Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="mario9999@gmail.com" name="email" required />
                                  

                                </div>
                                <div class="col-md-4 mb-4" >
                                    <label for="nom">Entrez votre Numero de telephone</label>
                                    <input type="tel" class="form-control"  placeholder="mario niki" name="numero"  required />
                                 

                                </div>          
                                
                               

                    </div>



                    <div class="form-group">
                            <div class="col-md-4 mb-3">
                                <label for="ville"> Ville</label>
                                <input type="text" class="form-control" id="ville" placeholder="ville" name="ville" required />
                                
                            </div>


                            <div class="col-md-4 mb-3">
                                <label for="Pays"> Pays</label>
                                <input type="text" class="form-control" id="Pays" placeholder="Pays" name="pays" required />
                            
                            </div>

                            <div class="date">
                                        <P>Date de Naissance</P>
                                        <label>JOUR</label>
                                    <select name="jour">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="1">8</option>
                                        <option value="2">9</option>
                                        <option value="3">10</option>
                                        <option value="4">11</option>
                                        <option value="5">12</option>
                                        <option value="6">13</option>
                                        <option value="7">14</option>
                                        <option value="1">15</option>
                                        <option value="2">16</option>
                                        <option value="3">17</option>
                                        <option value="4">18</option>
                                        <option value="5">19</option>
                                        <option value="6">20</option>
                                        <option value="7">21</option>
                                        <option value="1">22</option>
                                        <option value="2">23</option>
                                        <option value="3">24</option>
                                        <option value="4">24</option>
                                        <option value="5">26</option>
                                        <option value="6">27</option>
                                        <option value="7">28</option>
                                        <option value="1">29</option>
                                        <option value="2">30</option>
                                        <option value="3">31</option>
                                        
                                    </select>

                                    <label>MOIS</label>
                                    <select name="mois" id="mois">
                                        <option value="Janvier">Janvier</option>
                                        <option value="Fevrier">Fevrier</option>
                                        <option value="Mars">Mars</option>
                                        <option value="Avril">Avril</option>
                                        <option value="Mai">Mai</option>
                                        <option value="Juin">Juin</option>
                                        <option value="Juillet">Juillet</option>
                                        <option value="Août">Août</option>
                                        <option value="Septembre">Septembre</option>
                                        <option value="Octobre">Octobre</option>
                                        <option value="Novembre">Novembre</option>
                                        <option value="Decembre">Decembre</option>
                                        
                                    </select>
                                    <label>ANNEE</label>
                                    <select name="annee" id="annee">
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                        <option value="2007">2007</option>
                                        <option value="2006">2006</option>
                                        <option value="2005">2005</option>
                                        <option value="2004">2004</option>
                                        <option value="2003">2003</option>
                                        <option value="2002">2002</option>
                                        <option value="2001">2001</option>
                                        <option value="2000">2000</option>
                                        
                                    </select>
                            </div>
                            <br/>

                    </div>
                   
                    <button class="btn btn-primary" type="submit">ENREGISTRER</button>
                    <button class="btn btn-primary" type="reset">Effacer les Champs</button>

                </form>
                
         </div>


</div>
</body>
</html>