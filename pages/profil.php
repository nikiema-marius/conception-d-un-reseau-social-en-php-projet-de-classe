<?php require '../include/Acceuil.php' ;
$req = $pdo->prepare('SELECT images FROM user WHERE id = ?'); // une requete prepare selectionnant l'user dans notre base de donnee

$req->execute([$_SESSION['auth']->id]);
$img = $req->fetch();
//var_dump($img->images);
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
  <link rel="stylesheet" href="../css/profil.css">
  <title>Document</title>
</head>
<body>
<div class="container bootstrap snippets bootdey">

<div class="profile-page tx-13">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="profile-header">
                <div class="cover">
                    <div class="gray-shade"></div>
                    <figure>
                        <img src="../images/ouaga.jpg" class="img-fluid" alt="profile cover">
                    </figure>
                    <div class="cover-body d-flex justify-content-between align-items-center">
                        <div>
                        <?php if($img->images !=NULL){
                            echo  " <img class='profile-pic' src='../images/".$img->images."'   alt='profile'> " ; 
                            }else{
                                echo  " <img class='profile-pic' src='../images/obama.jpg'   alt='profile'> " ;
                            }
                        ?>
                            <span class="profile-name"><?= $_SESSION['auth']->username; ?></span>
                        </div>
                        <!--div class="d-none d-md-block">
                            <button class="btn btn-primary btn-icon-text btn-edit-profile"><i class='bx bx-edit ' ></i>
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg> Modifier couverture
                            </button>
                        </div-->
                    </div>
                </div>
                <div class="header-links">
                    <ul class="links d-flex align-items-center mt-3 mt-md-0">
                        
                        
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center" >
                        <i class='bx bx-user-check bx-lg'></i>
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <a class="pt-1px d-none d-md-block" href="ami_confirmer.php">Amis <span class="text-muted tx-12">7</span></a>
                        </li>
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <i class='bx bx-photo-album bx-lg' ></i>
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            <a class="pt-1px d-none d-md-block" href="photo.php">Galerie Photos</a>
                        </li>
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <i class='bx bx-video bx-lg' ></i>
                                <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                            <a class="pt-1px d-none d-md-block" href="#">Videos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
              <a href="#">
              <?php if($img->images !=NULL){
               echo  " <img class='profile-pic' src='../images/".$img->images."'   alt='profile'> " ; 
               }else{
                echo  " <img class='profile-pic' src='../images/obama.jpg'   alt='profile'> " ;
               }
               ?>
              </a>
              <h1><?= $_SESSION['auth']->nom; ?>
              <?= $_SESSION['auth']->prenom; ?></h1>
              <p><?= $_SESSION['auth']->email; ?></p>
          </div>

          <ul class="nav nav-pills nav-stacked">


          <?php $id=$_SESSION['auth']->id ; ?>



              <li class="active"><a href="#"> <i class='bx bx-user'></i> Profile</a></li>
              <!--li><a href="#"> <i class='bx bxs-calendar' ></i></i> Activité Recente<span class="label label-warning pull-right r-activity">9</span></a></li-->
              <?php   echo " <li><a href='modifier.php?id=".$id."'><i class='bx bxs-edit' ></i>  Modifier le Profile</a></li> " ; ?>
             

        <?php   echo " <li><a href='image.php?id=".$id."'><i class='bx bxs-camera' ></i>  Modifier photo</a></li> " ; ?>
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">
        <?php if($img->images !=NULL){
               echo  " <img class='profile-pic' src='../images/".$img->images."'   alt='profile' class='img-fluid' alt='photo_profil'  height='100px' width='300px'> " ; 
               }else{
                echo  " <img class='profile-pic' src='../images/obama.jpg'  alt='profile' class='img-fluid' alt='photo_profil'  height='100px' width='300px'> " ;
               }
        ?>
      <div class="panel">
          <form action="mur.php" method="GET">
              <textarea placeholder="Ecrit sur le Mur de <?= $_SESSION['auth']->username; ?>" rows="2" class="form-control input-lg p-text-area"></textarea>
              <button class="btn btn-warning pull-right">Poster sur le mur</button>
          </form>
          <footer class="panel-footer">
          <p></p>
              <ul class="nav nav-pills">
                  <li>
                      <a href="#"><i class='bx bxs-map bx-lg' ></i></a>
                  </li>
                  <li>
                  <?php   echo " <li><a href='modifier.php?id=".$id."'>  <i class='bx bxs-edit bx-lg' ></i></a>" ; ?>
                   
                      
                  </li>
              </ul>
          </footer>
      </div>
      <div class="panel">
          <div class="bio-graph-heading">
           
          </div>
          <div class="panel-body bio-graph-info">
              <h1>Information sur le profile de marius</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>NOM </span>: <?= $_SESSION['auth']->nom; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>PRENOM </span>: <?= $_SESSION['auth']->prenom; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>PAYS </span>: <?= $_SESSION['auth']->pays; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>DATE DE NAISSANCE</span>: <?= $_SESSION['auth']->jour; ?> <?= $_SESSION['auth']->mois; ?> <?= $_SESSION['auth']->annee; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Occupation </span>: informaticien</p>
                  </div>
                  <div class="bio-row">
                      <p><span>Email </span>: <?= $_SESSION['auth']->email; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Mobile </span>: <?= $_SESSION['auth']->numero; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Phone </span>: <?= $_SESSION['auth']->numero; ?></p>
                  </div>
              </div>
          </div>
      </div>
      <div>

     

     
      <?php

$idd = $_SESSION['auth']->id ;
$mur = $pdo->query("SELECT * FROM mon_mur WHERE mon_id = $idd" );




while($donne = $mur->fetch()){
    $affiche = $pdo->query("SELECT nom,prenom FROM user WHERE id = $donne->per_id " );
    while($don = $affiche->fetch()){ 
    echo " 


        
              <div class='col-md-4 mur'>
                  <div class='panel'>
                      <div class='panel-body'>
                          <div class='bio-chart'>
                              <div style='display:inline;width:100px;height:100px;'><canvas width='100' height='100px'></canvas><input class='knob' data-width='100' data-height='100' data-displayprevious='true' data-thickness='.2' data-fgcolor='#e06b7d' data-bgcolor='#e8e8e8' style='width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;'></div>
                          </div>
                          <div class='bio-desk'>
                              <h4 class='red'>".$don->nom."</h4>
                              <h4 class='red'>".$don->prenom."</h4>
                              <p>ecrit  le : ".$donne->date."</p>
                              <p>".$donne->le_mur."</p>
                          </div>
                      </div>
                  </div>
              </div>";
            }
        }
            ?> 





          
        
          </div>

  </div>
</div>

</div>
</div>
</body>
</html>