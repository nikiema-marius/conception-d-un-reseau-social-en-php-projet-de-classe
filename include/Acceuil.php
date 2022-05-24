<?php 
if(session_status() == PHP_SESSION_NONE ){
 session_start(); 
 require '../include/db.php';

 $req = $pdo->prepare('SELECT images,username FROM user WHERE id = ?'); // une requete prepare selectionnant l'user dans notre base de donnee

$req->execute([$_SESSION['auth']->id]);
$img = $req->fetch();
}
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Lien vers les boxicons-->
 <link rel="stylesheet" href="../boxicons/css/boxicons.min.css">
 <link rel="stylesheet" href="../css/bootstrap.min.css">
 <link rel="stylesheet" href="../css/header1.css">
 <script src="../js/bootstrap.min.js"></script>
 
    <title>Document</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
        <i class='bx bx-cool'></i>
        <span class="logo_name">FASO CHAT</span>
         </div>
                    
         <div class="row">
            <div class="col-10">
               <div class="list-group" id="list-tab" >   
                    <ul class="nav-links">
                            <li>
                                <a href="../pages/home.php">
                                    <i class='bx bx-grid-alt bx-tada-hover' ></i>
                                    <span class="link_name"> Home</span><!--lien pour l'acceuil-->
                                </a>
                            </li>

                            <li>
                                <a href="../pages/message.php">
                                    <i class='bx bx-message-dots bx-tada-hover'></i>
                                    <span class="link_name"> Messagerie<!--lien pour la messagerie-->
                                </a>
                            </li>
                            <li>
                                <a  href="../pages/profil.php">
                                    <i class='bx bxs-user bx-tada-hover'></i>
                                    <span class="link_name"> Profil</span><!--lien pour voire le profil-->
                                </a>
                            </li>
                        
                            
                        <li>
                            <a href="../pages/amis.php">
                                <i class='bx bxs-user-plus bx-tada-hover'></i>
                                <span class="link_name"> Amis</span><!--lien pour voire les amis et les invitations-->
                            </a>
                        </li>

                            <li>
                                <a href="../pages/notifications.php">
                                <i class='bx bx-notification bx-tada-hover'></i>
                                    <span class="link_name"> Notifications</span><!--notifications-->
                                </a>
                            </li>
                            <li>
                                <a href="../pages/parametre.php">
                                    <i class='bx bxs-news bx-tada-hover'></i>
                                    <span class="link_name"> Info</span>
                                </a>
                            </li>

                            <li>
                                <a href="../pages/logout.php">
                                    <i class='bx bx-log-out bx-tada-hover'></i>
                                    <span class="link_name"> Déconnection</span>
                                </a>
                            </li>
                            
                    </ul>
                </div>
            </div>
             </div>
    </div>

    <!-- home-->

    <div class="home-section">
        <nav>
            <div class="sidebar-button ">
                <i class='bx bx-menu sidebarBtn' ></i>
                <span class="dashboard"> FASO CHAT</span>
            </div>
            
            <div class="profile-details">
            <?php if($img->images !=NULL){
               echo  " <img class='profile-pic' src='../images/".$img->images."'   alt='photo'> " ; 
               }else{
                echo  " <img class='profile-pic' src='../images/obama.jpg'   alt='profile'> " ;
               }
               ?>
                <span class="admin_name"><?=$img->username;?> </span>
                <i class='bx bx-chevrons-down' ></i>
            </div>
            
        </nav>
    </div>
    <div class="home-sect">
    
        <div class="">
        

             
        <script src="../js/script.js"></script>