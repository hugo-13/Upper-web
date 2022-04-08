<?php

// Permet d'avoir le fichier nommé contact un seul fois le rendre unique
namespace ModelDemande;

use Core;

class ModelDemande
{

    // Select
    public function getCmd()
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM cmd LEFT JOIN ligcmd on (cmd.id_cmd = ligcmd.id_licmd) Inner join produit on (ligcmd.id_produit = produit.id_produit) Inner join client on (client.id_client = cmd.id_client)  ORDER BY date_cmd ASC");
        return $sql;
    }

    // Select
    public function getAllCmd($id_supp)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM cmd LEFT JOIN ligcmd on (cmd.id_cmd = ligcmd.id_licmd) Inner join produit on (ligcmd.id_produit = produit.id_produit) Inner join client on (client.id_client = cmd.id_client) WHERE id_cmd = '$id_supp'  ORDER BY date_cmd ASC");
        $result = $sql->fetch();
        return $result;
    }


    // delete licmd
    public function deleteLicmd($id_supp)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("DELETE FROM ligcmd WHERE id_licmd = '$id_supp'");
        $result = $sql->fetch();
        return $result;
    }

    public function deleteCmd($id_supp)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("DELETE FROM cmd WHERE id_cmd = '$id_supp'");
        $result = $sql->fetch();
        return $result;
    }

    public function searchMessage($select, $search)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de la table avec la recherche
        $sql = $bdd->query("SELECT * FROM cmd LEFT JOIN ligcmd on (cmd.id_cmd = ligcmd.id_licmd) Inner join produit on (ligcmd.id_produit = produit.id_produit) Inner join client on (client.id_client = cmd.id_client) where $select like ? ORDER BY date_cmd ASC", array($search));
        return $sql;
    }
}
