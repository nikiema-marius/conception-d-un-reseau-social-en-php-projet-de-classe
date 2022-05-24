


<?php  


function debuger($variable)
{
    echo '<pre>'. print_r($variable,true). '</pre>';
    # code...
}
?>
 
<?php
 function logged_only()
{
    if(session_status() == PHP_SESSION_NONE ){
        session_start(); 
       }

       if(!isset($_SESSION['auth'])){ 
           $_SESSION['flash']['danger'] = "vous n'avez pas le droit d'accéder à cette page ";
           header('Location: index.php');
           exit();

       }
}
?>




<?php



function Date_ConvertSqlTab($date_sql) {
    $jour = substr($date_sql, 8, 2);
    $mois = substr($date_sql, 5, 2);
    $annee = substr($date_sql, 0, 4);
    $heure = substr($date_sql, 11, 2);
    $minute = substr($date_sql, 14, 2);
    $seconde = substr($date_sql, 17, 2);
    
    $key = array('annee', 'mois', 'jour', 'heure', 'minute', 'seconde');
    $value = array($annee, $mois, $jour, $heure, $minute, $seconde);
    
    $tab_retour = array_combine($key, $value);
    
    return $tab_retour;
}

function AuPluriel($chiffre) {
    if($chiffre>1) {
        return 's';
    };
}



function TimeToJourJ($date_sql) {
    $tab_date = Date_ConvertSqlTab($date_sql);
    $mkt_jourj = mktime($tab_date['heure'],
                    $tab_date['minute'],
                    $tab_date['seconde'],
                    $tab_date['mois'],
                    $tab_date['jour'],
                    $tab_date['annee']);

    $mkt_now = time();
    
    $diff = $mkt_jourj - $mkt_now;
    
    $unjour = 3600 * 24;
    
    if($diff>=$unjour) {
        // EN JOUR
        $calcul = $diff / $unjour;
        return 'Il reste <strong>'.ceil($calcul).' jour'.AuPluriel($calcul).
'</strong>.';

    } elseif($diff<$unjour && $diff>=0 && $diff>=3600) {
        // EN HEURE
        $calcul = $diff / 3600;
        return 'Il reste <strong>'.ceil($calcul).' heure'.AuPluriel($calcul).
'</strong>.';

    } elseif($diff<$unjour && $diff>=0 && $diff<3600) {
        // EN MINUTES
        $calcul = $diff / 60;
        return 'Il reste <strong>'.ceil($calcul).' minute'.AuPluriel($calcul).
'</strong>.';

    } elseif($diff<0 && abs($diff)<3600) {
        // DEPUIS EN MINUTES
        $calcul = abs($diff) / 60;
        return 'Depuis <strong>'.ceil($calcul).' minute'.AuPluriel($calcul).
'</strong>.';

    } elseif($diff<0 && abs($diff)<=3600) {
        // DEPUIS EN HEURES
        $calcul = abs($diff) / 3600;
        return 'Depuis <strong>'.ceil($calcul).' heure'.AuPluriel($calcul).
'</strong>.';        

    } else {
        // DEPUIS EN JOUR
        $calcul = abs($diff) / $unjour;
        return 'Depuis <strong>'.ceil($calcul).' jour'.AuPluriel($calcul).
'</strong>.';

    };
}

?>





<?php

// require '../include/db.php';


//  function save_id()
// {
//    $id_article = $_GET['id_article'];

//    ob_start() ;
//    header('Location:commentaire.php?id_article='.$id_article);   

//    ob_end_flush();

// }
?>

