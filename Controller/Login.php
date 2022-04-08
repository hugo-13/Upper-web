<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Login;

use ModelLogin\ModelLogin;

// page model 

require('../Model/ModelLogin.php');

// class 
class Login
{
    private $erreur_email;
    private $erreur_pass;
    private $erreur_envoie;

    public function login()
    {


        session_start();

        // Si la variable je ne suis pas conneté 
        if (!isset($_SESSION['nom']) and !isset($_SESSION['admin'])) {


            // initialisation des erreurs
            $erreur_email = "";
            $erreur_pass = "";
            $erreur_envoie = "";

            // Récupération du bouton d'envoie
            $reg_login = filter_input(INPUT_POST, "reg_login", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($reg_login)) {

                // Récupération de l'email
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Récupération du mdp
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Condition si vide 
                if (empty($email)) {

                    // Message erreur 
                    $erreur_email = "Email Manquant *";
                    $erreurs = 1;
                }


                if (empty($password)) {

                    // Message erreur 
                    $erreur_pass = "Password Manquant *";
                    $erreurs = 1;
                }

                if ($email == 'Admin' and $password == 'fordfiestaW8') {

                    // mettre la session admin 
                    session_start();
                    $_SESSION['admin'] = "yes";
                    header('location:../backoffice/index.php');

                    // Si il n'y a aucune erreurs 
                }

                if (!isset($erreurs)) {
                    // Verifier les infos dans la bd 
                    // instenser la classe 
                    $addClient = new ModelLogin;
                    // Insertion des données 
                    $result = $addClient->selectClient($email);

                    // Si l'email coresspond a un des client
                    if ($result != false) {

                        // Si lemail et le mdp correspont au client 
                        if (password_verify($password, $result['password'])) {

                            // Si il a validé son compte par mail et que l'email et le mot de passe correspond a un des client 
                            if ($result['confirm'] == 1) {
                                $_SESSION['nom'] = $result['nom'];
                                $_SESSION['msg'] = "Vous revoilà " .$_SESSION['nom']. " !";
                                header('location:./');

                                // Si il n'a pas validé son compte 
                            } else {
                                $erreur_envoie = "Veuillez d'abord confirmer votre compte par mail !";
                            }

                            // Si l'email d'un client correspond mais pas son mdp 
                        } else {
                            $erreur_pass = "Le mot de passe ne correspond pas *";
                            $erreur_envoie = "Ce mot de passe ne correspond pas";
                        }

                        // Si l'email saisie ne correspond a aucun clients 
                    } else {
                        $erreur_email = "Email inconnue *";
                        $erreur_envoie = "Utilisateur inconnue !";
                    }
                }


                $this->erreur_pass = $erreur_pass;
                $this->erreur_email = $erreur_email;
                $this->erreur_envoie = $erreur_envoie;
            }
        } else {
            $_SESSION['msg'] = "Vous êtes déjà connecté";
            header('location:./');
        }
    }

    // fonction qui retourne les message d'erreurs 
    public function getErreurMail()
    {
        return $this->erreur_email;
    }

    public function getErreurPass()
    {
        return $this->erreur_pass;
    }

    public function getErreurEnvoie()
    {
        return $this->erreur_envoie;
    }


    
    // Page forgot psw 

    public function Forgot()
    {


        session_start();


            // initialisation des erreurs
            $erreur_email = "";
            $erreur_envoie = "";

            // Récupération du bouton d'envoie
            $reg_forgot = filter_input(INPUT_POST, "reg_forgot", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($reg_forgot)) {

                // Récupération de l'email
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Condition si vide 
                if (empty($email)) {

                    // Message erreur 
                    $erreur_email = "Email Manquant *";
                    $erreurs = 1;
                }

                if (!isset($erreurs)) {
                    // Verifier les infos dans la bd 
                    // instenser la classe 
                    $addClient = new ModelLogin;
                    // Insertion des données 
                    $result = $addClient->selectClient($email);

                    // Si l'email coresspond a un des client
                    if ($result != false) {
                    $key = $result['confirmkey'];


                        // Config du header 
                        $headers = "MIME-Version: 1.0\r\n";
                        $headers .= 'From:"upper-web.com"<support@upper.web.com' . "\n";
                        $headers .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                        $headers .= 'Content-Transfer-Encoding: 16bit';

                        // de : 
                        $to = $email;

                        // Message 
                        $subject = "Mot de passe oublié ?";
                        $message = "<html><body>";
                        $message .= '<h1 style="font-size:20px;">UPPER <span style="color:blue;">WEB</span></h1>';
                        $message .= '<h4>Avez-vous oublié votre mot de passe sur Upper-Web ?</h4>';
                        $message .= '<p>Pour le rénitialiser cliquez sur le lien ci-dessous !</p>';
                        $message .= '<a href="upper.alwaysdata.net/view/reset_psw.php?email=' . urlencode($email) . '&key=' . $key . '"><p>Cliquez ici pour rénitialiser votre mot de passe !</p></a>';
                        $message .= '</body></html>';


                        // Envoie 
                        if (mail($to, $subject, $message, $headers)) {

                            $erreur_envoie = "Un mail de rénitialisation de mot de passe vient de vous être envoyé !";
                            $this->erreur_envoie = $erreur_envoie;
                        } else {
                            $erreur_envoie = "UNE ERREUR EST SURVENUE *";
                            $this->erreur_envoie = $erreur_envoie;
                        }


                        // Si l'email saisie ne correspond a aucun clients 
                    } else {
                        $erreur_email = "Email inconnue *";
                        $erreur_envoie = "Utilisateur inconnue !";
                    }
                } else {
                    $erreur_envoie = "Veulliez saisir tous les champs correctements *";
                    $this->erreur_envoie = $erreur_envoie;
                }


                $this->erreur_email = $erreur_email;
                $this->erreur_envoie = $erreur_envoie;
            }

    }



    // Reset password page 
    private $erreur_password1;
    private $erreur_password2;


    public function resetPassword()
    {


        session_start();


        // instenser la classe 
        $updatePassword = new ModelLogin;



        // Si je ne suis pas deja connecté 
        if (!isset($_SESSION['nom']) and !isset($_SESSION['admin'])) {

            // et que l'url contient email 
            if (isset($_GET['email']) and isset($_GET['key'])) {



                // On récupère l'email et la clé du lien 
                $email = htmlspecialchars(urldecode($_GET['email']));
                $key = htmlspecialchars($_GET['key']);

                // On initialise un nouvelle clé 
                // Vérification par mail 
                $longueurKey = 15;
                $newkey = "";
                // key aleatoire
                for ($i = 1; $i < $longueurKey; $i++) {
                    $newkey .= mt_rand(0, 9);
                }

                // On selectionne toute la table 
                $result2 = $updatePassword->selectClient($email);

                // Si le mail ne coresspond à aucun client
                if ($email == $result2['email']) {

                    // Si le key ne corrspond pas a celui de l'utilisateur
                    if ($key == $result2['confirmkey']) {

                        // initialisation des erreurs
                        $erreur_password1 = "";
                        $erreur_password2 = "";
                        $erreur_envoie = "";

                        // Récupération du bouton d'envoie
                        $reg_reset = filter_input(INPUT_POST, "reg_reset", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        if (isset($reg_reset)) {

                            // Récupération des mdp
                            $password_1 = filter_input(INPUT_POST, "password_1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                            $password_2 = filter_input(INPUT_POST, "password_2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                            // Vérification password 
                            if (empty($password_1)) {

                                $erreur_password1 = "Password Manquant *";
                                $erreurs = 1;
                            } else {
                                $majuscule = preg_match('@[A-Z]@', $password_1);
                                $minuscule = preg_match('@[a-z]@', $password_1);
                                $chiffre = preg_match('@[0-9]@', $password_1);

                                if (!$majuscule || !$minuscule || !$chiffre) {

                                    // Message erreur 
                                    $erreur_password1 = "Password trop faible *";
                                    $erreurs = 1;
                                } else {

                                    if (strlen($password_1) < 6 or strlen($password_1) > 18) {

                                        // Message erreur 
                                        $erreur_password1 = "Password trop faible *";
                                        $erreurs = 1;
                                    } else {
                                        if ($password_1 != $password_2) {

                                            // Message erreur 
                                            $erreur_password2 = "Les deux password ne match pas *";
                                            $erreurs = 1;
                                        } else {
                                            $password = $password_1;

                                            // verification du mdp ne soit pas le meme que avant 
                                            if (password_verify($password, $result2['password'])) {
                                                // Message erreur 
                                                $erreur_password1 = "Le nouveaux mot de passe ne peut pas correspondre à l'ancien *";
                                                $erreurs = 1;
                                            }
                                        }
                                    }
                                }
                            }

                            if (!isset($erreurs)) {

                                // On crypt le mdp 
                                $password =  password_hash($password, PASSWORD_DEFAULT);

                                // Verifier les infos dans la bd 
                                // update des données 
                                $result = $updatePassword->updatePassword($password, $email);

                                // Si la requete a fonctionner 
                                if (isset($result)) {

                                    $_SESSION['nom'] = $result2['nom'];

                                    // update des données 
                                    $result3 = $updatePassword->updateKey($newkey, $email);

                                    if (isset($result3)) {
                                        $_SESSION['msg'] = "Mot de passe modifié !";
                                        header('location:../');
                                    }
                                }
                            } else {
                                $erreur_envoie = "Veulliez saisir tous les champs correctements *";
                            }

                            $this->erreur_password1 = $erreur_password1;
                            $this->erreur_password2 = $erreur_password2;
                            $this->erreur_envoie = $erreur_envoie;
                        }

                        // Si la key ne correspond pas 
                    } else {

                        $_SESSION['msg'] = "Ce lien à expiré";
                        $result3 = $updatePassword->updateKey($newkey, $email);
                            header('location:../');
                    }

                    // Si le mail ne correspond pas 
                } else {
                    $_SESSION['msg'] = "Utilisateur inconnue";
                    header('location:../');
                }

                // Si il n'y a rien 
            } else {
                $_SESSION['msg'] = "Information incorrect";
                header('location:../');
            }

            // si l'utilisateur est déjà connecté 
        } else {
            $_SESSION['msg'] = "Vous êtes déjà connecté";
            header('location:../');
        }
    }

    public function getErreurPassword1()
    {
        return $this->erreur_password1;
    }

    public function getErreurPassword2()
    {
        return $this->erreur_password2;
    }
}
