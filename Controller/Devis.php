<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Devis;

use ModelDevis\ModelDevis;

// page model 

require('../Model/ModelDevis.php');



class Devis
{
    // Propriétées -> encapsulation (protéger les propriétées (utilisable uniquement ici))
    private $site;
    private $description;
    private $image;


    private $erreur_exemple;
    private $erreur_message;
    private $erreur_captcha;
    private $erreur_envoie;



    public function devis()
    {

        session_start();

        // Message de si il n'y a aucune erreurs 
        $erreur_exemple = "";
        $erreur_message = "";
        $erreur_captcha = "";
        $erreur_envoie = "";





        if (isset($_SESSION['nom'])) {
            if (isset($_SESSION['devis'])) {

                $id_site = $_SESSION['devis'];

                $nom_client = $_SESSION['nom'];


                // instenser la classe 
                $devis = new ModelDevis;
                // Insertion des données 
                $result = $devis->Selectproduit($id_site);
                $site = $result['nom_produit'];
                $this->site = $site;
                $description = $result['description'];
                $this->description = $description;
                $image = $result['image'];
                $this->image = $image;


                // Récupération du bouton contact
                $reg_envoie = filter_input(INPUT_POST, "reg_envoie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if (isset($reg_envoie)) {

                    $this->captcha = filter_input(INPUT_POST, "captcha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                    if ($this->captcha != $_SESSION['captcha']) {

                        $erreur_captcha = "Captcha invalide *";
                        $erreurs = 1;
                    }

                    if (empty($message) or strlen($message) < 10) {

                        $erreur_message = "Message manquant ou trop court *";
                        $erreurs = 1;
                    } else {
                        if (strlen($message) > 150) {
                            $erreur_message = "Message trop long *";
                            $erreurs = 1;
                        }
                    }

                    // Si il n'y a pas d'erreur 
                    if (!isset($erreurs)) {

                        $getClient = $devis->getClient($nom_client);

                        if ($getClient != false) {

                            $id_client = $getClient['id_client'];


                            $getCmd = $devis->getCmd($id_client);


                            if ($getCmd != false) {
                                $id_clientcmd = $getCmd['id_client'];
                                if ($id_client == $id_clientcmd) {
                                    $erreur_envoie = "Vous avez déjà une demande en attente !";
                                    $erreurs = 1;
                                }
                            }


                            if (!isset($erreurs)) {

                                $addCmd = $devis->addCmd($message, $id_client);

                                if ($addCmd != false) {

                                    $getCmd = $devis->getCmd($id_client);

                                    if ($getCmd != null) {

                                        $id_cmd = $getCmd['id_cmd'];


                                        $getLigCmd = $devis->addLigCmd($id_cmd, $id_site);


                                        if ($getLigCmd != false) {

                                            // Config du header 
                                            $headers = "MIME-Version: 1.0\r\n";
                                            $headers .= "From: " . $nom_client . "\r\n";
                                            $headers .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                                            $headers .= 'Content-Transfer-Encoding: 16bit';

                                            $to = "upper.web13@gmail.com";
                                            $subject = "Demande de devis";
                                            $message2 = "<br>" . $nom_client . " vous à envoyé une demande de devis !";
                                            $message2 .= "<a href=''>Aller voir !</a>";

                                            if (mail($to, $subject, $message2, $headers)) {
                                                // TRIGGER 
                                                $regi =     $nom_client . " à envoyé une demande de devis \n[DATE] : " . date("d/m/y H:i:s") . "\n";
                                                historisation("log", "demande_devis", $regi);


                                                $_SESSION['msg'] = "Demande envoyé";
                                                header('location:./');
                                            }
                                        }
                                    } else {
                                        $erreur_envoie = "Une erreur est survenue *";
                                    }
                                } else {
                                    $erreur_envoie = "Une erreur est survenue **";
                                }
                            }
                        } else {
                            $_SESSION['msg'] = "Vous n'êtes pas connecté !";
                            header('location:./');
                        }
                    } else {
                        $erreur_envoie = "Veuillez saisir correctement tout les champs !";
                    }








                    $this->erreur_message = $erreur_message;
                    $this->erreur_captcha = $erreur_captcha;
                    $this->erreur_envoie = $erreur_envoie;
                }
            } else {
                header('location:../#devis');
            }
        } else {
            $_SESSION['msg'] = "Connectez-vous !";
            header('location:./');
        }
    }

    public function getErreurExemple()
    {
        return $this->erreur_exemple;
    }
    public function getErreurMessage()
    {
        return $this->erreur_message;
    }

    public function getErreurCaptcha()
    {
        return $this->erreur_captcha;
    }

    public function getErreurEnvoie()
    {
        return $this->erreur_envoie;
    }

    public function getSite()
    {
        return $this->site;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }
}
