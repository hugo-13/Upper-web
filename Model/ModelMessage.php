<?php

// Model pour recuperer les messages pour le back office
// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace ModelMessage;

use Core;

class ModelMessage
{
    public function readMessage()
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("SELECT * FROM contact ORDER BY date_message ASC");
        return $sql;
    }

    public function searchMessage($select, $search)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de la table avec la recherche
        $sql = $bdd->query("SELECT * from contact where $select like ? ORDER BY date_message ASC", array($search));
        return $sql;
    }

    public function selectEmail($id_supp)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture du mail correspondant a l'id selectionner 
        $sql = $bdd->query("SELECT email from contact where id_contact = ? ORDER BY date_message ASC", array($id_supp));
        return $sql;
    }

    public function deleteMessage($id_supp)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // supression 
        $sql = $bdd->query("DELETE from contact where id_contact = ?", array($id_supp));
        return $sql;
    }
}
