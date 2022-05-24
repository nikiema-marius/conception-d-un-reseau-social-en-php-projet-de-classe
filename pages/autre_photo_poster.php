
<?php require '../include/Acceuil.php' ?>



<?php
$id  = $_GET['id'];

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
   <link rel="stylesheet" href="../css/photo.css">
    <title>Document</title>
</head>
<body>
    
<div class="whos-speaking-area speakers pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text mb50">
                        <h2>GALERIE DE PHOTO </h2>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /.row  end-->
        <div class='row mb50'>
        <?php
        $rep = $pdo->prepare('SELECT  image FROM galerie WHERE id_pers = ?');
        $requete = $rep->execute(array($id));
        while($donne = $rep->fetch()){
         echo " 
           
       


    
            <div class='col-md-4' >
                <div class='speakers xs-mb30'>
                    <div class='spk-img'>
                        <img class='img-fluid' src='../images/galerie/$donne->image' alt='trainer-img' />
                       
                    </div>
                </div>
            </div>

            " ;
        }



        ?>

       
           
        </div> 
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>


</body>
</html>