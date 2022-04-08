<?php

// Permet d'avoir le fichier nommé contact un seul fois le rendre unique
namespace ModelDevis;

use Core;

class ModelDevis
{
    // Propriétées -> encapsulation (protéger les propriétées (utilisable uniquement ici))

    // Ajouter les donné a la table 
    public function selectProduit($id_site)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM produit WHERE id_produit = ? ", array($id_site));
        $result = $sql->fetch();
        return $result;
    }

    // Ajouter les donné a la table 
    public function getClient($nom_client)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM client WHERE nom = ? ", array($nom_client));
        $result = $sql->fetch();
        return $result;
    }

    // Ajouter les donné a la table 
    public function addCmd($message, $id_client)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("INSERT INTO cmd (message, id_client) VALUES (?,?)", array($message, $id_client));
        return $sql;
    }

    // Ajouter les donné a la table 
    public function getCmd($id_client)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("SELECT * FROM cmd where id_client = ?", array($id_client));
        $result = $sql->fetch();
        return $result;
    }

    // Ajouter les donné a la table 
    public function addLigCmd($id_cmd, $id_site)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("INSERT INTO ligcmd (id_licmd, id_produit) VALUES (?,?)", array($id_cmd, $id_site));
        return $sql;
    }
}
