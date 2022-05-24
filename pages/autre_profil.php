<?php require '../include/Acceuil.php'; ?>



<?php 


$id = $_GET['id'];


?>
<?php 

$req = $pdo->prepare('SELECT * FROM user WHERE id = ?'); // une requete prepare selectionnant l'user dans notre base de donnee

$req->execute([$id]);
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
                            <span class="profile-name"><?= $img->username; ?></span>
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
                        </li>
                        <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                        <i class='bx bx-photo-album bx-lg' ></i>
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                           <?php
                           echo " 
                           <a class='pt-1px d-none d-md-block' href='autre_photo_poster.php?id=".$id."'>Galerie Photos</a> 
                           ";  ?>
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
              <h1><?= $img->nom; ?>
              <?= $img->prenom; ?></h1>
              <p><?= $img->email; ?></p>
          </div>

          <ul class="nav nav-pills nav-stacked">


          <?php $id=$img->id ; ?>



             
              <!--li><a href="#"> <i class='bx bxs-calendar' ></i></i> Activité Recente<span class="label label-warning pull-right r-activity">9</span></a></li-->
             
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
              <textarea name="mur" value= $id placeholder="Ecrit sur le Mur de <?= $img->username; ?>" rows="2" class="form-control input-lg p-text-area"></textarea>
              <?php echo"<button class='btn btn-warning pull-right' name='id' value='$id' >Poster sur le mur</button>"; ?>
          </form>
          <footer class="panel-footer">
          <p></p>
              <ul class="nav nav-pills">
                  <li>
                    <i class='bx bxs-map bx-lg' ></i>
                  </li>
                  <li>
                  <li> <i class='bx bxs-edit bx-lg' ></i> 
                  </li>
              </ul>
          </footer>
      </div>
      <div class="panel">
          <div class="bio-graph-heading">
             je suis Nikiema marius communement appelé mario nik et Bill gate et je suis a votre service.
          </div>
          <div class="panel-body bio-graph-info">
              <h1>Information sur le profile de marius</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>NOM </span>: <?= $img->nom; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>PRENOM </span>: <?= $img->prenom; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>PAYS </span>: <?= $img->pays; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>DATE DE NAISSANCE</span>: <?=$img->jour; ?> <?= $img->mois; ?> <?= $img->annee; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Occupation </span>: informaticien</p>
                  </div>
                  <div class="bio-row">
                      <p><span>Email </span>: <?= $img->email; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Mobile </span>: <?= $img->numero; ?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Phone </span>: <?= $img->numero; ?></p>
                  </div>
              </div>
          </div>
      </div>
      
  </div>
</div>

</div>
</div>
</body>
</html>