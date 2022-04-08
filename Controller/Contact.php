<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Contact;

use ModelContact\ModelContact;

// page model 

require('../Model/ModelContact.php');



class Contact
{
    // Propriétées -> encapsulation (protéger les propriétées (utilisable uniquement ici))
    private $email;
    private $telephone;
    private $objet;
    private $message;
    private $captcha;

    private $erreur_mail;
    private $erreur_telephone;
    private $erreur_objet;
    private $erreur_message;
    private $erreur_envoie;
    private $erreur_captcha;



    public function contact()
    {

        session_start();

        // Message de si il n'y a aucune erreurs 
        $erreur_mail = "";
        $erreur_telephone = "";
        $erreur_objet = "";
        $erreur_message = "";
        $erreur_captcha = "";


        // Récupération du bouton contact
        $reg_contact = filter_input(INPUT_POST, "reg_contact", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        if (isset($reg_contact)) {


            //  filtre nom 
            $this->email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //  filtre nom 
            $this->telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //  filtre nom 
            $this->objet = filter_input(INPUT_POST, "objet", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //  filtre nom 
            $this->message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            // Captcha**
            //  filtre nom 
            $this->captcha = filter_input(INPUT_POST, "captcha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if ($this->captcha != $_SESSION['captcha']) {

                $erreur_captcha = "Captcha invalide *";
                $erreurs = 1;
            }







            // On vérirife le type 
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {

                // Message erreur 
                $erreur_mail = "Email invalide *";
                $erreurs = 1;
            }


            // verifier si les donné sont bien saisie 
            if (empty($this->email) || strlen($this->email) > 50) {

                // message d'erreur 
                $erreur_mail = "Email invalide *";
                $erreurs = 1;
            }
            // Condition si trouve un autre email identique 
            $readContact = new ModelContact;
            $readContact->testDuplicataMail($this->email);
            $result = $readContact->getTestDuplicataMail();

            if ($result != false) {

                // message d'erreur 
                $erreur_mail = "Un message a déjà été envoyé avec cette adresse mail *";
                $erreurs = 1;
            }

            if (empty($this->telephone) || !is_numeric($this->telephone) || strlen($this->telephone) > 20) {

                // message d'erreur 
                $erreur_telephone = "Téléphone invalide *";
                $erreurs = 1;
            } else {
                // Condition si trouve un autre email identique 
                $readContact = new ModelContact;
                $readContact->testDuplicataTelephone($this->telephone);
                $result2 = $readContact->getTestDuplicataTelephone();

                $tel_valid = preg_match('@0[1-9]@', $this->telephone);
                if (!$tel_valid) {

                    // Message erreur 
                    $erreur_telephone = "Telephone invalide *";
                    $erreurs = 1;
                } else {

                    if ($result2 != false) {

                        // message d'erreur 
                        $erreur_telephone = "Un message a déjà été envoyé avec ce numéro *";
                        $erreurs = 1;
                    }
                }
            }
            if (empty($this->objet)) {
                $erreur_objet = "Objet invalide *";
                $erreurs = 1;
            }

            if (strlen($this->objet) > 100) {
                $erreur_objet = "Objet trop long *";
                $erreurs = 1;
            }

            if (empty($this->message) || strlen($this->message) < 10) {
                $erreur_message = "Message manquant ou trop court *";
                $erreurs = 1;
            }

            if (strlen($this->message) > 1000) {
                $erreur_message = "Message trop long *";
                $erreurs = 1;
            }

            $this->erreur_mail = $erreur_mail;
            $this->erreur_telephone = $erreur_telephone;
            $this->erreur_objet = $erreur_objet;
            $this->erreur_message = $erreur_message;

            $this->erreur_captcha = $erreur_captcha;



            // garder les saut de ligne 
            $this->message = nl2br($this->message);
            $this->message = stripslashes($this->message);

            // Si les données on bien été saisie 
            if (!isset($erreurs)) {

                // Envoie d'un mail 
                // Config smtp 
                // on enleve les balise html 
                $this->message = strip_tags($this->message);

                // Config du header 
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "From: " . $this->email . "\r\n";
                $headers .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                $headers .= 'Content-Transfer-Encoding: 16bit';

                $to = "upper.web13@gmail.com";
                $subject = $this->objet;
                $message = "<br>Nouveaux message de : " . $this->email . " <br>depuis la page contact de upper-web<br><br>Téléphone : " . $this->telephone . "<br><br>Objet : " . $this->objet . ".<br><br>Message : <br>" . $this->message;


                // Si j'ai reçu le mail 
                if (mail($to, $subject, $message, $headers)) {

                    $msg_envoie = "Message envoyé";
                    // notif wiew 
                    notif_contact($msg_envoie);

                    // instenser la classe 
                    $addContact = new ModelContact;
                    $addContact->addContact($this->email, $this->telephone, $this->objet, $this->message);

                    // TRIGGER 
                    $regi =     $this->email . " à envoyé un message \n[DATE] : " . date("d/m/y H:i:s") . "\n";
                    historisation("log", "send_message", $regi);

                    // Si il y a un probleme quelconc 
                } else {
                    $erreur_envoie = "UNE ERREUR EST SURVENUE";
                    $this->erreur_envoie = $erreur_envoie;
                }
            }
        }
    }

    // retourner les erreur 
    public function getErreurMail()
    {
        return $this->erreur_mail;
    }
    public function getErreurTel()
    {
        return $this->erreur_telephone;
    }
    public function getErreurObjet()
    {
        return $this->erreur_objet;
    }
    public function getErreurMessage()
    {
        return $this->erreur_message;
    }

    public function getErreurEnvoie()
    {
        return $this->erreur_envoie;
    }

    public function getErreurCaptcha()
    {
        return $this->erreur_captcha;
    }
}
