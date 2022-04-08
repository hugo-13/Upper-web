<?php

// Permet d'avoir le fichier nommé contact un seul fois le rendre unique
namespace ModelCompte;

use Core;

class ModelCompte
{


    // Ajouter les donné a la table 
    public function selectClient($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM client LEFT JOIN type on (client.id_type = type.id_type) Inner join region on (client.id_region = region.id_region) WHERE nom = ?", array($nom));
        $result = $sql->fetch();
        return $result;
    }

    // Ajouter les donné a la table 
    public function deleteClient($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("DELETE FROM client WHERE nom = ?", array($nom));
        $result = $sql->fetch();
        return $result;
    }

    public function getIdClient($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM client WHERE nom = ?", array($nom));
        $result = $sql->fetch();
        return $result;
    }

    public function selectCmd($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM cmd LEFT JOIN ligcmd on (cmd.id_cmd = ligcmd.id_licmd) Inner join produit on (ligcmd.id_produit = produit.id_produit) WHERE id_client = ?", array($nom));
        $result = $sql->fetch();
        return $result;
    }


    public function deleteLigCmd($id_ligcmd)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("DELETE FROM ligcmd WHERE id_licmd = ?", array($id_ligcmd));
        $result = $sql->fetch();
        return $result;
    }

    public function deleteCmd($id_client)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("DELETE FROM cmd WHERE id_client = ?", array($id_client));
        $result = $sql->fetch();
        return $result;
    }
}
