<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Index;

use ModelRegister\ModelRegister;

// page model 

require('../Model/ModelRegister.php');
require('../Controller/Login.php');

// class 
class Index
{




    // Confirmation par email 
    public function ConfirmRegister()
    {

        session_start();
        if (isset($_GET['nom']) and isset($_GET['key']) and !empty($_GET['nom']) and !empty($_GET['key'])) {

            $nom = htmlspecialchars(urldecode($_GET['nom']));
            $key = htmlspecialchars($_GET['key']);
            // Requete pour trouver nom 
            $userconfirm = new ModelRegister;
            $userconfirm->userConfirm($nom);
            $userexist = $userconfirm->getConfirm();
            $user = $userconfirm->getUser();

            if ($userexist == 1) {
                if ($user['confirm'] == 0) {

                    // Changer le confirm dans la table 
                    $updateconfirm = new ModelRegister;
                    $updateconfirm->updateConfirm($nom, $key);
                    $_SESSION['nom'] = $nom;
                    $_SESSION['msg'] = "Bienvenue $nom";
                } else {
                    $_SESSION['nom'] = $nom;
                    $_SESSION['msg'] = "Compte déjà confirmé";
                }
            } else {
                $_SESSION['msg'] = "Utilisateur inconnue";
                $_SESSION['nom'] = null;
            }
        } else {

            if (isset($_SESSION['admin'])) {
                $_SESSION['msg'] = "Bienvenue Admin";
            }
        }
    }

    public function Devis()
    {
        // Récupération du bouton d'envoie
        $reg_devis = filter_input(INPUT_POST, "reg_devis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($reg_devis)){
            if (isset($_SESSION['nom'])){

                // Ouverture de devis 
                $_SESSION['devis'] = $reg_devis;
                header('location:./devis');

            } else {
                header('location:./');
                $_SESSION['msg'] = "Connectez-vous !";
            }
        }
    }
}
