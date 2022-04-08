<?php // Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Compte;

use ModelCompte\ModelCompte;

// page model 

require('../Model/ModelCompte.php');



use FPDF\FPDF;

require_once("../fpdf/fpdf.php");


// class 
class Compte
{
    private $nom;
    private $email;
    private $telephone;
    private $type;
    private $region;
    private $adresse;
    private $cp;

    private $nom_produit;
    private $description;
    private $image;
    private $exigence;

    private $erreur_password;
    private $erreur_password_2;



    public function compte()
    {
        session_start();
        if (isset($_SESSION['nom']) || isset($_SESSION['admin'])) {

            if (isset($_SESSION['nom'])) {
                $nom = $_SESSION['nom'];

                // instenser la classe 
                $compte_all = new ModelCompte;

                // On selectionne toute la table 
                $result = $compte_all->selectClient($nom);
                if ($result != false) {
                    $this->nom = $result['nom'];
                    $this->email = $result['email'];
                    $this->telephone = $result['telephone'];
                    $this->adresse = $result['adresse'];
                    $this->type = $result['nom_type'];
                    $this->region = $result['nom_region'];
                    $this->cp = $result['cp'];
                } else {
                    $_SESSION['msg'] = "UNE ERREUR EST SURVENUE *";
                    header('location:./');
                }


                $getClient = $compte_all->getIdClient($nom);
                $id_client = $getClient['id_client'];


                $result2 = $compte_all->selectCmd($id_client);
                if ($result2 != false) {
                    $_SESSION['compte_devis'] = "yes";
                    $this->nom_produit = $result2['nom_produit'];
                    $this->description = $result2['description'];
                    $this->exigence = $result2['message'];
                    $this->image = $result2['image'];
                    $this->id_ligcmd = $result2['id_licmd'];

                    $reg_download = filter_input(INPUT_POST, "reg_download", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    if (isset($reg_download)) {
                        $pdf = new FPDF();
                        $pdf->AddPage();
                        $pdf->SetDrawColor(0, 0, 0); // noir


                        $pdf->SetTextColor(0, 0, 0); // noir
                        // --- Cell(largeur, hauteur, texte, bord, placement, alignement, remplissage, lien)
                        $pdf->SetFont('Courier', 'B', 32);
                        $pdf->Cell(190, 10, "UPPER WEB", 0, 0, 'C', 0);
                        $pdf->ln(25);

                        $pdf->SetFont('Courier', 'B', 12);

                        $pdf->SetFillColor(0, 127, 255); // bleu
                        $pdf->Cell(190, 20, "Demande de devis", 1, 1, 'C', 2);

                        $pdf->SetFont('Courier', 'B', 12);

                        $pdf->SetFillColor(199, 199, 199); // gris
                        $pdf->Cell(40, 12, "Client", 1, 0, 'C', 1);
                        $pdf->Cell(35, 12, "Nb commande", 1, 0, 'C', 1);
                        $pdf->Cell(55, 12, "Site", 1, 0, 'C', 1);
                        $pdf->Cell(60, 12, "Date", 1, 1, 'C', 1);

                        $pdf->SetFont('Courier', '', 11);
                        $pdf->Cell(40, 12, utf8_decode($this->nom), 1, 0, 'C', 0);
                        $pdf->Cell(35, 12, utf8_decode($this->id_ligcmd), 1, 0, 'C', 0);
                        $pdf->Cell(55, 12, utf8_decode($this->nom_produit), 1, 0, 'C', 0);
                        $pdf->Cell(60, 12, utf8_decode($result2['date_cmd']), 1, 0, 'C', 0);
                        $pdf->ln(10);


                        $pdf->Image("../images/logo.png", 50, 90, 100, 30);
                        // --- Redirection vers le navigateur
                        $pdf->Output();
                    }
                } else {
                    $_SESSION['compte_devis'] = false;
                }
            }

            // Partie supression de compte
            $reg_delete = filter_input(INPUT_POST, "reg_delete", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Partie redirection vers la pâge de modification 
            $reg_modify = filter_input(INPUT_POST, "reg_modify", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($reg_delete)) {
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $erreur_password = "";

                if (empty($password)) {
                    $erreur_password = "Password Manquant *";
                    $erreurs = 1;
                }

                if (!isset($erreurs)) {
                    if (password_verify($password, $result['password'])) {

                        // Supperssion
                        $compte_all->deleteClient($nom);
                        if ($compte_all) {
                            session_destroy();
                            session_start();
                            $_SESSION['msg'] = 'Compte supprimé !';
                            header('location:./');
                        }

                    } else {
                        $erreur_password = "Mots de passe incorrecte *";
                    }
                }
                $this->erreur_password = $erreur_password;





                // Partie bouton modification 
            } else {

                // Si j'appuie sur le bouton de modification 
                if (isset($reg_modify)) {
                    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $erreur_password = "";

                    if (empty($password)) {
                        $erreur_password = "Password Manquant *";
                        $erreurs = 1;
                    }

                    if (!isset($erreurs)) {
                        if (password_verify($password, $result['password'])) {

                            if (isset($compte_all)) {
                                header('location:./update/compte');
                            }
                        } else {
                            $erreur_password = "Mots de passe incorrecte *";
                        }
                    }
                    $this->erreur_password = $erreur_password;
                }
            }











            $nom = $_SESSION['nom'];
            $getClient = $compte_all->getIdClient($nom);
            $id_client = $getClient['id_client'];
            // Partie supression de compte
            $reg_delete_2 = filter_input(INPUT_POST, "reg_delete_2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Partie redirection vers la pâge de modification 
            $reg_modify_2 = filter_input(INPUT_POST, "reg_modify_2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($reg_delete_2)) {
                $password_2 = filter_input(INPUT_POST, "password_2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $erreur_password_2 = "";

                if (empty($password_2)) {
                    $erreur_password_2 = "Password Manquant *";
                    $erreurs = 1;
                }

                if (!isset($erreurs)) {
                    if (password_verify($password_2, $result['password'])) {

                        // Supperssion
                        $result6 = $compte_all->selectCmd($id_client);
                        if ($result6) {
                            $id_ligcmd = $result6['id_licmd'];
                            $verif1 = $compte_all->deleteLigCmd($id_ligcmd);
                            $verif2 = $compte_all->deleteCmd($id_client);
                            $_SESSION['compte_devis'] = false;
                        }
                    } else {
                        $erreur_password_2 = "Mots de passe incorrecte *";
                    }
                }
                $this->erreur_password_2 = $erreur_password_2;





                // Partie bouton modification 
            } else {

                // Si j'appuie sur le bouton de modification 
                if (isset($reg_modify_2)) {
                    $password_2 = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $erreur_password_2 = "";

                    if (empty($password_2)) {
                        $erreur_password_2 = "Password Manquant *";
                        $erreurs = 1;
                    }

                    if (!isset($erreurs)) {
                        if (password_verify($password_2, $result['password'])) {

                            if (isset($compte_all)) {
                                header('location:./update/compte');
                            }
                        } else {
                            $erreur_password_2 = "Mots de passe incorrecte *";
                        }
                    }
                    $this->erreur_password_2 = $erreur_password_2;
                }
            }
        } else {
            $_SESSION['msg'] = "Vous n'êtes pas connecté";
            header('location:./');
        }
    }



    public function getNom()
    {
        return $this->nom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getTelephone()
    {
        return $this->telephone;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getRegion()
    {
        return $this->region;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function getCp()
    {
        return $this->cp;
    }

    public function getErreurPassword()
    {
        return $this->erreur_password;
    }


    public function getErreurPassword_2()
    {
        return $this->erreur_password_2;
    }

    public function getNomProduit()
    {
        return $this->nom_produit;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getExigence()
    {
        return $this->exigence;
    }
    public function getImage()
    {
        return $this->image;
    }
}
