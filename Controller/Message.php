<?php


// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace Message;

use ModelMessage\ModelMessage;


// page model 

require('../Model/ModelMessage.php');


// class 
class Message
{
    private $select;
    private $search;
    private $id_supp;

    // Getter variable 
    private $total;
    private $result;
    private $console;

    // Affichage dans le tableaux 
    public function message()
    {

        session_start();

        // Si je suis connnecté en tant que Admin 
        if (isset($_SESSION['admin'])) {

            // Récupération du bouton search
            $reg_message = filter_input(INPUT_POST, "message_search", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Si j'appuie sur le boutton search
            if (isset($reg_message)) {

                //  filtre search
                $search = filter_input(INPUT_POST, "search", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Si la recherche est vide
                if (empty($search)) {
                    // instenser la classe 
                    $getMessage = new ModelMessage;
                    // Recuperatioen des valeur 
                    $result = $getMessage->readMessage();
                    $this->result = $result;
                    // Total de message trouvé (ligne)
                    $total =  $this->result->rowCount();
                    $this->total = $total;

                    // Messge dans la console 
                    $console = "";
                    $this->console = $console;

                    // Si la recherche n'est pas vide     
                } else {

                    // Récuperation selon les champ saisie 
                    $select = filter_input(INPUT_POST, "selected", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $this->select = $select;
                    $this->search = $search;

                    // instenser la classe 
                    $getMessage = new ModelMessage;
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

                // Si je n'appuie pas sur le boutton search 
            } else {

                // instenser la classe 
                $getMessage = new ModelMessage;
                // Recuperatioen des valeur 
                $result = $getMessage->readMessage();
                $this->result = $result;

                // Total de message trouvé (ligne)
                $total =  $this->result->rowCount();
                $this->total = $total;

                // Messge dans la console 
                $console = "";
                $this->console = $console;
            }
            // Si je ne suis pas connecté en tant que Admin 
        } else {
            header('location:./');
        }
    }

    // Delete message
    public function messageDelete()
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
                    $deleteMessage = new ModelMessage;
                    // Recuperatioen des valeur 
                    $email_delete = $deleteMessage->selectEmail($this->id_supp);
                    $email = $email_delete->fetch();

                    // Si on trouve au moins un mail
                    if ($email != false) {

                        // Retour pour le changement de boutton 
                        $retour_delete = 1;
                        $this->retour_delete = $retour_delete;
                        // supression 
                        // On selectionne que le mail 
                        $output = array_slice($email, 1);
                        // On transform le tablau en string 
                        $ligne_email = implode(", ", $output);
                        $this->ligne_email = $ligne_email;
                        echo "Le message de $ligne_email vient d'être supprimé <br>";

                        // On peut supprimer la valeur 
                        $deleteMessage->deleteMessage($this->id_supp);
                        $total_delete = $deleteMessage->deleteMessage($this->id_supp)->rowCount();

                        // TRIGGER 
                        $regi =     "[IP USER] : "  . $_SERVER['REMOTE_ADDR'] . " à suprimé un message de $ligne_email\n[DATE] : " . date("d/m/y H:i:s") . "\n";
                        historisation("log", "delete_message", $regi);
                    }
                }

                // Si rien n'est seclection 
            } else {
                echo "Aucun message sélectionné";
            }
        }
    }




    // Récupération du total de message 
    public function getMessage()
    {
        return $this->result;
    }


    // Récupération du total de message 
    public function getTotal()
    {
        return $this->total;
    }

    // Récupération du total de message 
    public function getSearch()
    {
        return $this->console;
    }
}
