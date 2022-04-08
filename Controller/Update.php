<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Update;

use ModelUpdate\ModelUpdate;

// page model 

require('../Model/ModelUpdate.php');

// class 
class Update
{

    // Message d'erreur
    private $erreur_nom;
    private $erreur_email;
    private $erreur_telephone;
    private $erreur_type;
    private $erreur_region;
    private $erreur_adresse;
    private $erreur_captcha;
    private $erreur_password;

    //resultat envoie
    private $result_region;
    private $captcha;
    private $erreur_envoie;


    private $nom2;
    private $email2;
    private $telephone2;
    private $type2;
    private $region2;
    private $adresse2;
    private $cp;









    public function ReadRegion()
    {
        // instenser la classe 
        $getRegion = new ModelUpdate;
        // Recuperatioen des valeur 
        $result_region = $getRegion->getRegion();
        $this->result_region = $result_region;
    }





    public function update()
    {

        session_start();



        $confirm = 1;

        // initialisation des erreurs
        $erreur_nom = "";
        $erreur_email = "";
        $erreur_telephone = "";
        $erreur_type = "";
        $erreur_region = "";
        $erreur_adresse = "";
        $erreur_captcha = "";
        $erreur_envoie = "";
        $erreur_password = "";


        // Si la variable je ne suis pas conneté 
        if (isset($_SESSION['nom'])) {

            $getid = new ModelUpdate;
            $nom = $_SESSION['nom'];
            $getid->getClient($nom);
            $result4 = $getid->getClient($nom);
            $id =  $result4['id_client'];


            $nom2 = $result4['nom'];
            $email2 = $result4['email'];
            $telephone2 = $result4['telephone'];
            $type2 = $result4['nom_type'];
            $region2 = $result4['nom_region'];
            $cp2 = $result4['cp'];
            $adresse2 = $result4['adresse'];

            $this->nom2 = $nom2;
            $this->email2 = $email2;
            $this->telephone2 = $telephone2;
            $this->type2 = $type2;
            $this->region2 = $region2;
            $this->cp2 = $cp2;
            $this->adresse2 = $adresse2;














            // Récupération du bouton d'envoie
            $reg_register = filter_input(INPUT_POST, "reg_register", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Si j'appuie sur le boutoon 
            if (isset($reg_register)) {

                // Récupération du nom
                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de l'email
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération du tel
                $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération du type
                $type = filter_input(INPUT_POST, "pour", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de la region
                $region = filter_input(INPUT_POST, "where", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de l'adresse
                $adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération de l'adresse
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);



                // Captcha**
                //  filtre nom 
                $this->captcha = filter_input(INPUT_POST, "captcha", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                if ($this->captcha != $_SESSION['captcha']) {

                    $erreur_captcha = "Captcha invalide *";
                    $erreurs = 1;
                }


                $vide = 0;


                // Vérification nom
                if (empty($nom)) {

                    // Message erreur 
                    $nom = $result4['nom'];
                    $this->nom = $nom;
                    $vide = $vide + 1;
                } else {
                    if (strlen($nom) > 20) {

                        // Message erreur 
                        $erreur_nom = "Nom invalide *";
                        $erreurs = $erreurs + 1;
                    } else {
                        // Condition si trouve un autre email identique 
                        $testdupli = new ModelUpdate;
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
                    $email = $result4['email'];
                    $this->email = $email;
                    $vide = $vide + 1;
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
                            $testdupli = new ModelUpdate;
                            $testdupli->testDuplicataMail($email);
                            $result = $testdupli->getTestDuplicataMail();

                            if ($result != false) {

                                // message d'erreur 
                                $erreur_email = "Cette email existe déjà *";
                                $erreurs = 1;
                            } else {
                                $confirm = 0;
                            }
                        }
                    }
                }

                // Vérification telephone 
                if (empty($telephone)) {

                    // Message erreur 
                    $telephone = $result4['telephone'];
                    $this->telephone = $telephone;
                    $vide = $vide + 1;
                } else {

                    if (strlen($telephone) > 20) {

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
                            $testdupli = new ModelUpdate;
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
                    $adresse = $result4['adresse'];
                    $this->adresse = $adresse;
                    $vide = $vide + 1;
                } else {

                    if (strlen($adresse) > 100) {

                        // Message erreur 
                        $erreur_adresse = "Adresse invalide *";
                        $erreurs = 1;
                    }
                }


                // Si les champs ne sont pas vide 
                if ($vide != 6) {
                    // Si il n'y a pas d'erreurs 




                    if (empty($password)) {

                        // Message erreur 
                        $erreur_password = "Password Manquant *";
                        $erreurs = 1;
                        $this->erreur_password = $erreur_password;
                    }



                    if (!isset($erreurs)) {


                        // Si lemail et le mdp correspont au client 
                        if (password_verify($password, $result4['password'])) {

                            $confirm = 0;
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
                            $to = $this->email;

                            // Message 
                            $subject = "Confirmation de compte";
                            $message = "<html><body>";
                            $message .= '<h4>Bonjour, et bienvenue sur upper-web your designer web !</h4>';
                            $message .= '<p>pour confirmer la mise à jour de votre compte veillez cliquer sur le lien ci-dessous</p>';
                            $message .= '<a href="upper.alwaysdata.net/?nom=' . urlencode($nom) . '&key=' . $key . '"><p>Cliquez ici pour confirmer votre compte !</p></a>';
                            $message .= '</body></html>';


                            // Envoie 
                            if (mail($to, $subject, $message, $headers)) {
                                // instenser la classe 
                                $addClient = new ModelUpdate;
                                // Insertion des données 
                                $verification = $addClient->updateClient($nom, $email, $telephone, $type, $region, $adresse, $key, $confirm, $id);
                                if ($verification != null) {
                                    session_destroy();
                                    session_start();
                                    $_SESSION['msg'] = "Un mail vous à été envoyé !";
                                    header('location:../');
                                }
                            } else {
                                $erreur_envoie = "UNE ERREUR EST SURVENUE *";
                                $this->erreur_envoie = $erreur_envoie;
                            }
                        } else {
                            $erreur_password = 'Le mode passe est incorrecte !';
                            $this->erreur_password = $erreur_password;
                            $erreur_envoie = "Veulliez saisir tous les champs correctements *";
                            $this->erreur_envoie = $erreur_envoie;
                        }
                    } else {
                        $erreur_envoie = "Veulliez saisir tous les champs correctements *";
                        $this->erreur_envoie = $erreur_envoie;
                    }

                    // transfer 
                    $this->erreur_email = $erreur_email;
                    $this->erreur_nom = $erreur_nom;
                    $this->erreur_telephone = $erreur_telephone;
                    $this->erreur_type = $erreur_type;
                    $this->erreur_region = $erreur_region;
                    $this->erreur_adresse = $erreur_adresse;
                    $this->erreur_captcha = $erreur_captcha;

                    // Si toutes les valeurs sont vide 
                } else {
                    $erreur_envoie = 'Veuillez changer au moins un champs';
                    $this->erreur_envoie = $erreur_envoie;
                }
            }
        } else {
            $_SESSION['msg'] = "Vous n'êtes pas connecté";
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

    public function getErreurCaptcha()
    {
        return $this->erreur_captcha;
    }

    public function getErreurEnvoie()
    {
        return $this->erreur_envoie;
    }

    public function getErreurPassword()
    {
        return $this->erreur_password;
    }



    public function getNom()
    {
        return $this->nom2;
    }
    public function getEmail()
    {
        return $this->email2;
    }
    public function getTelephone()
    {
        return $this->telephone2;
    }
    public function getType()
    {
        return $this->type2;
    }
    public function getRegion2()
    {
        return $this->region2;
    }
    public function getCp()
    {
        return $this->cp2;
    }
    public function getAdresse()
    {
        return $this->adresse2;
    }
}
