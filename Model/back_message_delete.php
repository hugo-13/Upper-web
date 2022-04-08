
<?php

require_once('../config/setup.php');
require_once('../vendor/autoload.php');


$connexion = getPDO();

// mettre le date en heure française 
date_default_timezone_set('Europe/Paris');
//************************************ Partie users **************************************************************/

//fichier log 
include "../controller/function.php";


// initialisation des variable

$email_contact = "";
$telephone_contact = "";
$objet_contact    = "";
$message_contact = "";
$retour = 0;


$errors = array();



$date_now = new DateTime('now');


//************************************ Si jappuie sur soummettre ******************************/

try {








    // search part 
    if (isset($_POST['message_search'])) {
        if (empty($_POST['search'])) {
            // Afficher toutes les donné dans la table 
            $sql = "SELECT * FROM contact ORDER BY date_message ASC";
            $result = $connexion->query($sql);
        } else {
            $selected = $_POST['selected'];
            $search = $_POST['search'];
            // afficher les valeur saisie de la table 
            $requete ="SELECT * from contact where $selected like '$search'";
            $result = $connexion->prepare($requete);
            $sql = $result->execute();
            $verif = $result ->rowCount();
            if ($verif == 0){
                array_push($errors, "Acune données trouvé pour ".$selected. " = " .$search);
            } else {
                array_push($errors, $verif." données trouvées pour ".$selected. " = " .$search);
            }
        }
    } else {
        // Afficher toutes les donné dans la table 
        $sql = "SELECT * FROM contact ORDER BY date_message ASC";
        $result = $connexion->query($sql);
    }

    // delete part 
    if (isset($_POST['delete_message'])) {
        if (isset($_POST['check'])) {
            foreach ($_POST['check'] as $id_ligne) {
                $id_supp = intval($id_ligne);

                // recuperation de lemail suprimmé pour avoir un suivie dans les logs 
                $sql2 = "SELECT email from contact where id_contact = '$id_supp'";
                $result3 = $connexion->query($sql2);
                while ($ligne3 = $result3->fetch(PDO::FETCH_ASSOC)) {
                    $email_supp = $ligne3['email'];
                }

                // supression 
                $sql2 = "DELETE from contact where id_contact = '$id_supp'";
                $retour = $connexion->exec($sql2);

                // fichier log 
                $connexion->beginTransaction();
                $connexion->rollBack();



                if ($retour == 1) {
                    //MESSAGE
                    array_push($errors, "Le message de <span style='color:white;'>" . $email_supp . "</span> vient d'être supprimé");
                    $regi =     "[IP USER] : "  . $_SERVER['REMOTE_ADDR'] . " à suprimé un message de  " . $email_supp . "\n[DATE] : " . date("d/m/y H:i:s") . "\n";
                    historisation("log", "delete_message", $regi);
                }
            }
        } else {
            array_push($errors, "Aucune ligne sélectionnée");
        }
    }


    if (isset($_POST['refresh_message'])) {
        header('location:./message');
    }
} catch (PDOException $e) {
    //SI IL Y A UNE ERREUR L'ENSEMBLE DES REQUETES EST ANNULEE ON REVIENT A L'ETAT INITIAL
    $connexion->beginTransaction();
    $connexion->rollBack();
    //GESTION DES ERREURS
    $erreur =  "--ERREUR REQUETE LE " . date("d/m/y H:i:s") . "--\n";
    $erreur = $erreur . "[FICHIER] : " . $e->getFile() . "\n";
    $erreur = $erreur . "[LIGNE] : " . $e->getLine() . "\n";
    $erreur = $erreur . "[CODE] : " . $e->getCode() . "\n";
    $erreur = $erreur . "[MESSAGE] : " . $e->getMessage() . "\n";
    // LA NOTATION .= revient a la meme chose qu'au dessus
    $erreur .=  "[IP USER] : " . $_SERVER['REMOTE_ADDR'] . "\n";
    historisation("log", "erreur_requete", $erreur);
    //ERREUR POUR L'ECRAN USER
    array_push($errors, "UNE ERRREUR EST SURVENUE");
}
