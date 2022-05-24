
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
if(!empty($_POST)&& !empty($_POST['email']) && !empty($_POST['password'])){
  require_once '../include/db.php';
  require_once '../include/debug.php';
  $req =$pdo->prepare('SELECT * FROM user WHERE email = :email'); 
  $req->execute(['email' => $_POST['email']]);
  $user = $req->fetch(PDO::FETCH_OBJ);
  //debuger($user);
  //debuger($user->password);
    if($user && password_verify($_POST['password'],$user->password)){
       session_start();
    $_SESSION['auth'] = $user;
   echo "<h2> Vous êtes maitenant bien connecté au site</h2>";
    header('Location: ../pages/home.php');
    exit();  
    }else{
      echo "<h2 style='color: red;' > mot de passe ou email incorrecte</h2>";
    }
}
 
// session_start(); 
?>




    <div class="container">
        <div class="login-box">
            <h2>Connection</h2>
            <form action="" method="POST">
              <img src="../fonts/icons/person.svg" alt="Bootstrap" width="30" height="30" style="margin-left: 150px;" >
                                <div class="user-box">
                                  <input type="email" name="email" required>
                                  <label> Email</label>
                                </div>
                                <div class="user-box">
                                  <input type="password" name="password" required>
                                  <i class="fa fa-eye"></i>
                                  <label>Password</label>
                                </div>
                                <div class="row mb-4">
                                  <div class="col d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                      <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value=""
                                        id="form2Example3"
                                        checked
                                      />
                                      <label class="form-check-label" for="form2Example3" style="color: white;"> Se souvenir de Moi </label>
                                    </div>
                                  </div>

                                  <div class="col">
                                    <!-- Simple link -->
                                    <a href="recuperation.php">Forgot password?</a>
                                  </div>
                                </div>
                                <div class="envoie">
                                  <span></span>
                                  <span></span>
                                  <span></span>
                                  <span></span>
                                <button type="submit" >Envoyer</button>
                                </div>

                                  <!-- Register buttons -->
                    <div class="text-center">
                      <p style="color: white;">tu n'est pas encore inscrit ? <a href="inscription.php">Inscription</a></p>
                    
                    </div>

            </form>
            <div>
            <?php// debuger($_SESSION); ?>
            </div>
          </div>
          
    </div>
    <script src="js/verif.js" ></script>
</body>
</html>