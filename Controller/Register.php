<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Register;

use ModelRegister\ModelRegister;

// page model 

require('../Model/ModelRegister.php');

// class 
class Register
{

    // Message d'erreur
    private $erreur_nom;
    private $erreur_email;
    private $erreur_password;
    private $erreur_password_match;
    private $erreur_telephone;
    private $erreur_type;
    private $erreur_region;
    private $erreur_adresse;
    private $erreur_accept;
    private $erreur_captcha;

    //resultat envoie
    private $result_region;
    private $captcha;
    private $erreur_envoie;








    public function ReadRegion()
    {
        // instenser la classe 
        $getRegion = new ModelRegister;
        // Recuperatioen des valeur 
        $result_region = $getRegion->getRegion();
        $this->result_region = $result_region;
    }





    public function register()
    {

        session_start();


        // initialisation des erreurs
        $erreur_nom = "";
        $erreur_email = "";
        $erreur_password = "";
        $erreur_password_match = "";
        $erreur_telephone = "";
        $erreur_type = "";
        $erreur_region = "";
        $erreur_adresse = "";
        $erreur_accept = "";
        $erreur_captcha = "";
        $erreur_envoie = "";


        // Si la variable je ne suis pas conneté 
        if (!isset($_SESSION['nom']) and !isset($_SESSION['admin'])) {



            // Récupération du bouton d'envoie
            $reg_register = filter_input(INPUT_POST, "reg_register", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Si j'appuie sur le boutoon 
            if (isset($reg_register)) {

                // Récupération du nom
                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de l'email
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération du mdp
                $password_1 = filter_input(INPUT_POST, "password_1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération du mdp2
                $password_2 = filter_input(INPUT_POST, "password_2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération du tel
                $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération du type
                $type = filter_input(INPUT_POST, "pour", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de la region
                $region = filter_input(INPUT_POST, "where", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de l'adresse
                $adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de la condition
                $accept = filter_input(INPUT_POST, "accept", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Captcha**
                //  filtre nom 
                $this->captcha = filter_input(INPUT_POST, "captcha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                if ($this->captcha != $_SESSION['captcha']) {

                    $erreur_captcha = "Captcha invalide *";
                    $erreurs = 1;
                }



                // Vérification nom
                if (empty($nom)) {

                    // Message erreur 
                    $erreur_nom = "Nom Manquant *";
                    $erreurs = 1;
                } else {
                    if (strlen($nom) > 20) {

                        // Message erreur 
                        $erreur_nom = "Nom invalide *";
                        $erreurs = 1;
                    } else {
                        // Condition si trouve un autre email identique 
                        $testdupli = new ModelRegister;
                        $testdupli->testDuplicataNom($nom);
                        $result3 = $testdupli->getTestDuplicataNom();

                        if ($result3 != false) {

                            // message d'erreur 
                            $erreur_nom = "Ce nom existe déjà *";
                            $erreurs = 1;
                        }
                    }
                }

                // Vérification email 
                if (empty($email)) {

                    // Message erreur 
                    $erreur_email = "Email Manquant *";
                    $erreurs = 1;
                } else {

                    // On vérirife le type 
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                        // Message erreur 
                        $erreur_email = "Email invalide *";
                        $erreurs = 1;
                    } else {

                        if (strlen($email) > 50) {

                            // Message erreur 
                            $erreur_email = "Email invalide *";
                            $erreurs = 1;
                        } else {

                            // Condition si trouve un autre email identique 
                            $testdupli = new ModelRegister;
                            $testdupli->testDuplicataMail($email);
                            $result = $testdupli->getTestDuplicataMail();

                            if ($result != false) {

                                // message d'erreur 
                                $erreur_email = "Cette email existe déjà *";
                                $erreurs = 1;
                            }
                        }
                    }
                }

                // Vérification password 
                if (empty($password_1)) {

                    // Message erreur 
                    $erreur_password = "Password Manquant *";
                    $erreurs = 1;
                } else {
                    $majuscule = preg_match('@[A-Z]@', $password_1);
                    $minuscule = preg_match('@[a-z]@', $password_1);
                    $chiffre = preg_match('@[0-9]@', $password_1);

                    if (!$majuscule || !$minuscule || !$chiffre) {

                        // Message erreur 
                        $erreur_password = "Password trop faible *";
                        $erreurs = 1;
                    } else {

                        if (strlen($password_1) < 6 or strlen($password_1) > 18) {

                            // Message erreur 
                            $erreur_password = "Password trop faible *";
                            $erreurs = 1;
                        } else {
                            if ($password_1 != $password_2) {

                                // Message erreur 
                                $erreur_password_match = "Les deux password ne match pas *";
                                $erreurs = 1;
                            } else {
                                $password = $password_1;
                            }
                        }
                    }
                }

                // Vérification telephone 
                if (empty($telephone)) {

                    // Message erreur 
                    $erreur_telephone = "Téléphone Manquant *";
                    $erreurs = 1;
                } else {

                    if (strlen($telephone) > 10) {

                        // Message erreur 
                        $erreur_telephone = "Telephone invalide *";
                        $erreurs = 1;
                    } else {

                        if (!is_numeric($telephone)) {

                            // Message erreur 
                            $erreur_telephone = "Telephone invalide *";
                            $erreurs = 1;
                        } else {
                            // Condition si trouve un autre email identique 
                            $testdupli = new ModelRegister;
                            $testdupli->testDuplicataTelephone($telephone);
                            $result2 = $testdupli->getTestDuplicataTelephone();

                            if ($result2 != false) {

                                // message d'erreur 
                                $erreur_telephone = "Ce numéro existe déjà *";
                                $erreurs = 1;
                            } else {
                                $tel_valid = preg_match('@0[1-9]@', $telephone);
                                if (!$tel_valid) {

                                    // Message erreur 
                                    $erreur_telephone = "Telephone invalide *";
                                    $erreurs = 1;
                                }
                            }
                        }
                    }
                }

                // Vérification type 
                if (empty($type)) {

                    // Message erreur 
                    $erreur_type = "Vous-êtes ?? *";
                    $erreurs = 1;
                }

                // Vérification region 
                if (empty($region)) {

                    // Message erreur 
                    $erreur_region = "Région Manquante *";
                    $erreurs = 1;
                }

                // Vérification adresse 
                if (empty($adresse)) {

                    // Message erreur 
                    $erreur_adresse = "Adresse Manquante *";
                    $erreurs = 1;
                } else {

                    if (strlen($adresse) > 100) {

                        // Message erreur 
                        $erreur_adresse = "Adresse invalide *";
                        $erreurs = 1;
                    }
                }

                // Vérification accept 
                if (empty($accept)) {

                    // Message erreur 
                    $erreur_accept = "Veuillez accepter les conditions d'inscriptions *";
                    $erreurs = 1;
                }



                // Si il n'y a pas d'erreurs 
                if (!isset($erreurs)) {

                    // On crypt le mdp 
                    $password =  password_hash($password, PASSWORD_DEFAULT);

                    // Vérification par mail 
                    $longueurKey = 15;
                    $key = "";
                    // key aleatoire
                    for ($i = 1; $i < $longueurKey; $i++) {
                        $key .= mt_rand(0, 9);
                    }





                    // Config du header 
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= 'From:"upper-web.com"<support@upper.web.com' . "\n";
                    $headers .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                    $headers .= 'Content-Transfer-Encoding: 16bit';

                    // de : 
                    $to = $email;

                    // Message 
                    $subject = "Confirmation de compte";
                    $message = "<html><body>";
                    $message .= '<h4>Bonjour, et bienvenue sur upper-web your designer web !</h4>';
                    $message .= '<p>pour confirmer votre inscription veillez cliquer sur le lien ci-dessous</p>';
                    $message .= '<a href="upper.alwaysdata.net/?nom=' . urlencode($nom) . '&key=' . $key . '"><p>Cliquez ici pour confirmer votre compte !</p></a>';
                    $message .= '</body></html>';


                    // Envoie 
                    if (mail($to, $subject, $message, $headers)) {
                        // instenser la classe 
                        $addClient = new ModelRegister;
                        // Insertion des données 
                        $verification = $addClient->addClient($nom, $email, $password, $telephone, $type, $region, $adresse, $key);
                        if ($verification != null) {
                            $_SESSION['msg'] = "Un mail vous à été envoyé !";
                            header('location:./');
                        }
                    } else {
                        $erreur_envoie = "UNE ERREUR EST SURVENUE *";
                        $this->erreur_envoie = $erreur_envoie;
                    }
                } else {
                    $erreur_envoie = "Veulliez saisir tous les champs correctements *";
                    $this->erreur_envoie = $erreur_envoie;
                }













                // transfer 
                $this->erreur_password = $erreur_password;
                $this->erreur_email = $erreur_email;
                $this->erreur_nom = $erreur_nom;
                $this->erreur_password_match = $erreur_password_match;
                $this->erreur_telephone = $erreur_telephone;
                $this->erreur_type = $erreur_type;
                $this->erreur_region = $erreur_region;
                $this->erreur_adresse = $erreur_adresse;
                $this->erreur_accept = $erreur_accept;
                $this->erreur_captcha = $erreur_captcha;
            }
        } else {
            $_SESSION['msg'] = "Vous êtes déjà connecté";
            header('location:./');
        }
    }







    public function getRegion()
    {
        return $this->result_region;
    }






    // fonction qui retourne les message d'erreurs 
    public function getErreurNom()
    {
        return $this->erreur_nom;
    }

    public function getErreurEmail()
    {
        return $this->erreur_email;
    }

    public function getErreurPassword()
    {
        return $this->erreur_password;
    }

    public function getErreurPasswordMatch()
    {
        return $this->erreur_password_match;
    }

    public function getErreurTelephone()
    {
        return $this->erreur_telephone;
    }

    public function getErreurType()
    {
        return $this->erreur_type;
    }

    public function getErreurRegion()
    {
        return $this->erreur_region;
    }

    public function getErreurAdresse()
    {
        return $this->erreur_adresse;
    }

    public function getErreurAccept()
    {
        return $this->erreur_accept;
    }

    public function getErreurCaptcha()
    {
        return $this->erreur_captcha;
    }

    public function getErreurEnvoie()
    {
        return $this->erreur_envoie;
    }
}
