<?php require '../include/Acceuil.php' ?>
<?php require '../include/debug.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/b.min.css">
  <link rel="stylesheet" href="../css/message.css">
  <title>Document</title>
</head>
<body>
<div class="container">



<?php 
//$id_envoyeur = (int) $_GET['id_per'];

$id_confirm =(int)$_SESSION['auth']->id;
if(!empty($_GET['id_per'])){
    $id_envoyeur = (int) $_GET['id_per'];
  
    $req = $pdo->query("SELECT * FROM user WHERE user.id ='$id_envoyeur'");
    $nb =   $req->fetch(); 


  
    $req = $pdo->query("SELECT * FROM user WHERE user.id ='$id_confirm'");
    $na =   $req->fetch(); 
   
    }
    

 $req = $pdo->prepare("SELECT COUNT(id) AS nb_amis FROM amis_confirmer WHERE ( id_amis_avec =? OR id_amis_confir =? ) ");
                        
 $req->execute(array( $id_confirm , $id_confirm ));
 $nb_conversations = $req->fetch();
 //echo $nb_conversations->nb_amis;





$req = $pdo->prepare("SELECT u.nom, u.prenom , u.id , m.message, m.id_envoyeur, m.lu ,m.date_message ,m.id_moi,u.images
FROM (
    SELECT IF(r.id_amis_avec = ? , r.id_amis_confir , r.id_amis_avec) AS id_utilisateur , MAX(m.id) AS max_id 
	FROM amis_confirmer AS r 
	LEFT JOIN messagerie AS m ON (( m.id_envoyeur , m.id_moi ) = (r.id_amis_confir,r.id_amis_avec) OR (m.id_envoyeur , m.id_moi) = (r.id_amis_avec , r.id_amis_confir))
	WHERE (r.id_amis_confir = ? OR r.id_amis_avec = ?) 
	 GROUP BY IF(m.id_envoyeur = ?,m.id_moi,m.id_envoyeur) , r.id) AS DM
LEFT JOIN messagerie AS m ON m.id = DM.max_id
LEFT JOIN user AS u ON u.id = DM.id_utilisateur  
ORDER BY m.date_message DESC LIMIT 20 ");
                        
$req->execute(array( $id_confirm , $id_confirm, $id_confirm, $id_confirm ));
$affichier_conversation = $req->fetchAll(PDO::FETCH_ASSOC);
//print_r( $affichier_conversation);
//die;
?>



<!--requete pour recuperer les messages -------SELECT u.nom, u.prenom , u.id , m.message, m.id_envoyeur, m.lu
FROM (
    SELECT IF(r.id_amis_avec = 4 , r.id_amis_confir , r.id_amis_avec) AS id_utilisateur , MAX(m.id) AS max_id 
	FROM amis_confirmer AS r 
	LEFT JOIN messagerie AS m ON (( m.id_envoyeur , m.id_moi ) = (r.id_amis_confir,r.id_amis_avec) OR (m.id_envoyeur , m.id_moi) = (r.id_amis_avec , r.id_amis_confir))
	WHERE (r.id_amis_confir = 4 OR r.id_amis_avec = 4) 
	 GROUP BY IF(m.id_envoyeur = 4,m.id_moi,m.id_envoyeur) , r.id) AS DM
LEFT JOIN messagerie AS m ON m.id = DM.max_id
LEFT JOIN user AS u ON u.id = DM.id_utilisateur  
ORDER BY m.date_message DESC;   -->



    <!--  debut de laPage headeR  -->
    <div class="page-title">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <h5 class="title">Discutions</h5>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"> </div>
        </div>
    </div>
    <!-- fin de la Page header  -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card m-0">

                    <!-- Row start -->
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                            <div class="users-container">
                                <div class="chat-search-box">
                                <form action="#" method="POST">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-info" >Rechercher
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                                
                                <ul class="users">


                                  
                                <?php foreach ($affichier_conversation as $ac) { 
                                    if($ac){  ?>
                                    <li class="person" data-chat="person1">
                                    <?php echo " 
                                    <a href='message.php?id_per=".$ac['id']." '>"; 
                                    ?>
                                        <div class="user">
                                        <?php if ($ac['images']) {
                                            echo " <img src='../images/publications/".$ac['images']."' alt='Retail Admin'>";
                                        }else{
                                            echo " <img src='../images/publications/obama.jpg' alt='Retail Admin'>"; 
                                        }
                                        
                                        ?>
                                            <span class="status busy"></span>
                                        </div>
                                        <p class="name-time">
                                            <span class="name"><h4><?=$ac['nom'] ?> <?=$ac['prenom'] ?></h3></span>
                                            <div class="last-message text-muted"><?=$ac['date_message']?></div>
                                            <?php if($ac['id_envoyeur'] <> $id_confirm && $ac['lu'] == 0 && isset($ac['date_message'])) {  echo " 
                                            <small class='time text-muted'>".TimeToJourJ( $ac['date_message'] )."</small>

                                            <small class='chat-alert label label-danger'> Nouveau </small>";
                                        }
                                            ?>
                                        </p>
                                        </a>
                                    </li>
                                    <?php }}?>


                                </ul>
                            </div>
                        </div>

                    <!-- traitement des messages  les message -->

                   
                    


                    
                    <!-- fin des traitement des messages  -->





    <!-- pour afficher les message a gauche et a droite -->






              

                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
                            <div class="selected-user">
                                
                                <span>A: <span class="name"><?=$ac['nom'] ?></span></span>
                            </div>
                            <div class="chat-container">
                                <ul class="chat-box chatContainerScroll">

                                <?php 

                                if(!empty($_GET['id_per'])){
                                $req = $pdo->prepare("SELECT *  FROM messagerie WHERE ( (id_envoyeur ,id_moi) = (:id1, :id2) OR (id_envoyeur ,id_moi) = (:id2, :id1)) 
    
                                               ORDER BY id ASC");

                                $req->execute(array( 'id1' =>$id_confirm ,'id2'=>$id_envoyeur ));
                                
                                $afficher_message = $req->fetchAll(PDO::FETCH_ASSOC);
                               // print_r($afficher_message);
                               foreach($afficher_message as $message){


                                if ( $message['id_envoyeur'] == $id_envoyeur )
                                {

                                        echo "
                                        
                                    <li class='chat-left'>
                                           <div class='chat-avatar'>
                                                <img src='../images/".$nb->images."' alt='Photo de ".$nb->prenom." '>
                                                <div class='chat-name'>
                                                    <h4>".$nb->username." </h4>
                                                </div>
                                            </div>
                                            <div class='chat-text'>
                                            ".$message['message']."
                                            </div>
                                            <div class='chat-hour'>".$message['date_message']."<span class='fa fa-check-circle'></span></div>
                                      </li>
                                        ";


                                }
                                else{

                                    
                                    echo "
                                        
                                            <li class='chat-right'>
                                                <div class='chat-hour'>".$message['date_message']." <span class='fa fa-check-circle'></span></div>
                                                <div class='chat-text'>

                                                "
                                                .$message['message']."
                                                </div>
                                                <div class='chat-avatar'>
                                                    <img src='../images/".$na->images."' alt='Photo de".$na->prenom." '>
                                                    <div class='chat-name'>
                                                    <h4> MOI </h4>
                                                    </div>
                                                </div>
                                            </li>
                                                    
                                    ";



                                }

                               }
                            }
                                  
                               ?>

                                </ul>
                               
                                <?php 
                                if(!empty($_GET['id_per'])){
                                // var_dump($id_envoyeur);
                                // exit;
                                echo "
                                <form action='message_verif.php' method='GET' class='sms'>
                                
                                
                                    <textarea class='form-control me-2' name='message' placeholder='Votre message'></textarea>
                                    <button type='submit' name='envoyer'  value='$id_envoyeur' ><i class='bx bxl-telegram'></i></button>
                                    ";
                                }
                                    ?>
                                </form>
                            </div>
                        </div>
                        
                     <!-- Fin des scripts pour les messages   -->
                    </div>
                    <!-- Row end -->
                </div>

            </div>

        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->

</div>

</div>
</body>
</html>