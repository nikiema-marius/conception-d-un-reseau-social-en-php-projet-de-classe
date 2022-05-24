<?php  ob_start() ; ?>

<?php require '../include/Acceuil.php' ?>




<?php 


$id_confirm =(int)$_SESSION['auth']->id;
$id_envoyeur = (int) $_GET['envoyer'];
var_dump($id_envoyeur);
//exit;


                    if (!empty($_GET['message']))
                    {
                      //  $id_envoyeur = (int) $_GET['id_per'];
                        extract($_GET);
                        $invalid = (boolean) true;
                        //var_dump($_GET['message']);
                       // exit;
                        if(isset($_GET['message'])){
                            $message =$_GET['message'];

                            $message = (string) trim($message);
                            if(empty($message)){
                                $invalid = false;
                                $er_message = "il faut ecrire un message";
                            }

                            if($invalid){
                                var_dump($message);
                               //var_dump($id_envoyeur);
                                $date_message = date("y-m-d h:m:s");
                                
                                $req = $pdo->prepare("INSERT INTO messagerie (id_envoyeur,id_moi,message,date_message,lu) VALUES(?,?,?,?,?)");
                                  // if()                     
                               $p =  $req->execute(array($id_confirm,$id_envoyeur,$message,$date_message, 0 ));
                              // var_dump($p);
                                
                            }
                          //  header('Status: 301 Moved Permanently', false, 301); 
                            header('Location: message.php?id_per='.$id_envoyeur);
                            ob_end_flush();
                        }
                      
                    }
                    
                    
                    
                    ?>




