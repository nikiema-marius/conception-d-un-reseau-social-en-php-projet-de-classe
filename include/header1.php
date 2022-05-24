
<?php 
if(session_status() == PHP_SESSION_NONE ){
 session_start(); 
}
  ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faso Tchat</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="..fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/connection.css">
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">">
</head>
<body>
    <!-- Entete -->

    <!-- menu de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" id="header">
        <div class="container">
                <a href="#" class="navbar-brand">Faso Tchat</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                    <i class="fas fa-bars"></i>    
                    Menu
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        <?php if(isset($_SESSION['auth'])): ?>

                        <li><a href="../pages/logout.php" class="nav-link">Déconnecter</a></li>
                            
                        <li class="nav-item"><a class="nav-link" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Accueil</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Mon Compte</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Messagerie</a></li>
                       <li class="nav-item"><a href="" class="nav-link">Notifications</a></li>
                        <?php else: ?>
                       <?php endif;?>
                    </ul>
               </div>
        </div>
    </nav>
     <?php if(isset($_SESSION['flash'])): ?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?= $type; ?>">
          <?= $message; ?>
        </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']);?>
        <?php endif;?>
       
  </div>
</div>

<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" >Home</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Profile</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Messages</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Settings</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">..fehy.</div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...ejhtyju</div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">.jryt..</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...rjyuky</div>
    </div>
  </div>
</div>
