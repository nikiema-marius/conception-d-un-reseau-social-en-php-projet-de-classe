<?php
require_once '../include/db.php';
session_start();

$id = $_GET['id'] ;
     $image = '' ;

    // echo 'votre id est '.$_GET['id'];

    if (isset($_POST))
    {
        $image             =  $_FILES['image']['name']; // image
        $imagePath          = '../images/'.basename($image);// chemin de l image 
        $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION); // l extension de l image 

        $isSuccess         = true ;
        $isUploadSuccess   = false;
        


      
        if (empty($image)) {
            $imageError ='Ce champ ne peut être vide' ;
            $isSuccess = false ;
        }
        else{

            $isUploadSuccess = true ; 


            // verification de l extension de l image
            if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $imageError = " Les fichiers autorisés sont : .jpg , .png , .jpeg , .gif " ;
                $isUploadSuccess = false ;
            }

            // voir si l image n existe pas deja 
            
            // verification de la taille pas > 500 KB
            


            if ($isUploadSuccess) 
            {    
               
                // prendre le chemin temporaire et mettre dans le bon chemin 
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath ) ) 
                {
                    $imageError = "il y a une erreur lors de l' upload ";
                    $isUploadSuccess = false ;
                }
            }
        }
        //var_dump($image);

        if ($isSuccess && $isUploadSuccess ) 
        {  
          
            
            $req = $pdo -> prepare("UPDATE  user SET images = ? where id = ?");
            $req->execute(array($image,$id));
            header('Location:profil.php');

        }

    }
    else{
        echo 'error';
        die;
    }


    function checkInput ($data)
    {
        $data = trim($data) ;
        $data = stripslashes($data) ;
        $data = htmlspecialchars($data) ;

        return $data ;
    }

    

?>