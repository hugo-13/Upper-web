<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Demande;

use ModelDemande\ModelDemande;
use ModelDevis\ModelDevis;

// page model 

require('../Model/ModelDemande.php');


// class 
class Demande
{
    private $result;
    private $total;
    private $console;


    // Affichage dans le tableaux 
    public function demande()
    {



        // Si je suis connnecté en tant que Admin 
        if (isset($_SESSION['admin'])) {


            // Récupération du bouton search
            $reg_message = filter_input(INPUT_POST, "message_search", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($reg_message)) {

                //  filtre search
                $search = filter_input(INPUT_POST, "search", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if (empty($search)) {
                    // instenser la classe 
                    $getMessage = new ModelDemande;
                    // Recuperatioen des valeur 
                    $result = $getMessage->getCmd();
                    $this->result = $result;

                    // Total de message trouvé (ligne)
                    $total =  $this->result->rowCount();
                    $this->total = $total;

                    // Messge dans la console 
                    $console = "";
                    $this->console = $console;
                } else {
                    // Récuperation selon les champ saisie 
                    $select = filter_input(INPUT_POST, "selected", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $this->select = $select;
                    $this->search = $search;

                    // instenser la classe 
                    $getMessage = new ModelDemande;
                    // Recuperatioen des valeur 
                    $result = $getMessage->SearchMessage($this->select, $this->search);
                    $this->result = $result;
                    // Total de message trouvé (ligne)
                    $total =  $this->result->rowCount();
                    $this->total = $total;

                    // Messge dans la console 
                    $console = "Pour " . $select . " = " . $search;
                    $this->console = $console;
                }
            } else {

                // instenser la classe 
                $getMessage = new ModelDemande;
                // Recuperatioen des valeur 
                $result = $getMessage->getCmd();
                $this->result = $result;

                // Total de message trouvé (ligne)
                $total =  $this->result->rowCount();
                $this->total = $total;

                // Messge dans la console 
                $console = "";
                $this->console = $console;
            }
        } else {
            header('location:./');
        }
    }
















    // Delete message
    public function deleteDemande()
    {

        // Récupération du bouton delete
        $reg_delete = filter_input(INPUT_POST, "reg_delete", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        // Si j'appuie sur supprimer
        if (isset($reg_delete)) {


            // Récupération du bouton delete
            $check = filter_input(INPUT_POST, 'check', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            // Si au moins un des case est checké 
            if (isset($check)) {
                // Récupération du tableau des id à supprimés
                foreach ($check as $id_ligne) {

                    $id_supp = intval($id_ligne);
                    $this->id_supp = $id_supp;

                    // instenser la classe 
                    $getMessage = new ModelDemande;
                    $result = $getMessage->getAllCmd($id_supp);
                    $nom = $result['nom'];
                    $getMessage->deleteLicmd($id_supp);
                    $getMessage->deleteCmd($id_supp);

                    // TRIGGER 
                    $regi =     "[IP USER] : "  . $_SERVER['REMOTE_ADDR'] . " à suprimé la demande de $nom\n[DATE] : " . date("d/m/y H:i:s") . "\n";
                    historisation("log", "delete_message", $regi);

                    echo "La demande de $nom vient d'être supprimée <br>";
                }

                // Si rien n'est seclection 
            } else {
                echo "Aucun message sélectionné";
            }
        }
    }

















    // Récupération du total de message 
    public function getDemande()
    {
        return $this->result;
    }    // Récupération du total de message 
    public function getTotal()
    {
        return $this->total;
    }

    // Récupération du total de message 
    public function getConsole()
    {
        return $this->console;
    }
}
