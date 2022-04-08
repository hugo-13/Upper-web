
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

$errors = array();



$date_now = new DateTime('now');


//************************************ Si jappuie sur soummettre ******************************/

try {
    if (isset($_POST['reg_contact'])) {

        $email_contact = $_POST['email_contact'];
        $telephone_contact = $_POST['telephone_contact'];
        $objet_contact = $_POST['objet_contact'];
        $message_contact = $_POST['message_contact'];

        //  filtre nom 
        $email_contact = filter_input(INPUT_POST, "email_contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //  filtre nom 
        $telephone_contact = filter_input(INPUT_POST, "telephone_contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //  filtre nom 
        $objet_contact = filter_input(INPUT_POST, "objet_contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //  filtre nom 
        $message_contact = filter_input(INPUT_POST, "message_contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // garder les saut de ligne 
        $message_contact = nl2br($message_contact);
        $message_contact = stripslashes($message_contact);


        // verifier si les donné sont bien saisie 
        if (empty($email_contact) || strlen($email_contact) > 100) {
            array_push($errors, "Email manquant");
        } else {
            // partie delaie de temp entre chaque envoie de mail 
            // je selectionne toute la table contact 
            $sql = "SELECT * FROM contact";
            //JE LANCE MA REQUETE ET JE STOCKE LE RESULTAT DANS $RESULT
            $result = $connexion->query($sql);

            // verification de duplicata email et username  
            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                // je cherche si un email correspond a celui ci 
                if ($ligne['email'] == $email_contact) {
                    array_push($errors, "Vous avez déjà un message en attente de réponse");
                }
            }
        }





        if (empty($telephone_contact) || !is_numeric($telephone_contact) || strlen($telephone_contact) > 20) {
            array_push($errors, "Téléphone invalide");
        }
        if (empty($objet_contact)) {
            array_push($errors, "Objet invalide");
        }

        if (strlen($objet_contact) > 100) {
            array_push($errors, "Objet trop long");
        }




        if (empty($message_contact) || strlen($message_contact) < 10) {
            array_push($errors, "Message manquant ou trop court");
        }

        if (strlen($message_contact) > 1000) {
            array_push($errors, "Message trop long");
        }






        // si il ny a aucune erreur et que toutes les info sont  
        if (count($errors) == 0) {

            // insertion des donné dans la table 
            $sql = "INSERT INTO contact (email, telephone, objet, message)
            VALUES('$email_contact', '$telephone_contact', '$objet_contact', '$message_contact')";
            $retour = $connexion->exec($sql);
            if ($retour == 1) {
                //SI REQUETE FAITE

                notif_contact();

                // fichier log 
                $connexion->beginTransaction();
                $connexion->rollBack();
                //MESSAGE
                $regi =    "[EMAIL] : " . $email_contact . " à envoyé un message \n[DATE] : " . date("d/m/y H:i:s") . "\n";
                historisation("log", "contact", $regi);
                $sucsess = "Votre message à bien été envoyé";
            }
        }
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
