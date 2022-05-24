<?php
require_once '../include/db.php';
  require_once '../include/debug.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../js/bootstrap.min.js">
    <title>Faso_chat</title>
</head>
<body>
  <h1>BIENVENUE SUR FASO TCHAT</h1>


  <?php 

 // die;
if(!empty($_POST)&& !empty($_POST['email']) && !empty($_POST['username'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
 
  $req =$pdo->prepare('SELECT email,username FROM user WHERE email =?'); 
  $req->execute(array($email));
  $user = $req->fetch(PDO::FETCH_OBJ);
    if($user!= NULL && $user->username =$username){

      if(empty($_POST['password']) || $_POST['password'] != $_POST['confirmPassword']){
        echo "vous devez rentrer un mot de passe valide ";
        header('Location: recuperation.php');
    }else
    {   $username = $_POST['username'];
     // var_dump($username);
     // die;
        $mot_pass =password_hash($_POST['password'],PASSWORD_BCRYPT);
        $req =$pdo->prepare('UPDATE user SET password = ? WHERE username =? '); 
        $req->execute(array($mot_pass,$username));
        header('Location: index.php');
        exit();
    }  

   // header('Location: mot_pass_oublier.php');

    exit();  
    }else{
    
      echo " email incorrecte Ou Username introuvable";
   
    }
}

?>




    <div class="container">
        <div class="login-box">
            <h2> Renitialisation de votre Password</h2>
            <form action="" method="POST">
              <img src="../fonts/icons/person.svg" alt="Bootstrap" width="30" height="30" style="margin-left: 150px;" >
                    <div class="user-box">
                        <input type="email" name="email" required>
                        <label> Entrer votre Email</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="username" required>
                        <i class="fa fa-eye"></i>
                        <label>Entrer votre username</label>
                    </div>

                    <div class="user-box">
                        <input type="password" name="password" required>
                        <label> Entrer votre Nouveau mot de pass</label>
                    </div>
                    <div class="user-box">
                        <input type="password" name="confirmPassword" required>
                        <i class="fa fa-eye"></i>
                        <label>confirmer le mot de pass</label>
                    </div>
                    <div class="envoie">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                      <button type="submit" >Renitialisation</button>
                    </div>
 <!-- Register buttons -->
                  

            </form>
            <div>
            <?php// debuger($_SESSION); ?>
            </div>
          </div>
          
    </div>
    <script src="js/verif.js" ></script>
</body>
</html>