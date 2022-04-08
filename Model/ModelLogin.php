<?php

// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace ModelLogin;

use Core;

class ModelLogin
{

    // Propriétées -> encapsulation (protéger les propriétées (utilisable uniquement ici))



    public function addClient($nom, $email, $password, $telephone, $type, $region, $adresse, $key)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("INSERT INTO client (nom, email, password, telephone, id_type, id_region, adresse, confirmkey) VALUES (?,?,?,?,?,?,?,?)", array($nom, $email, $password, $telephone, $type, $region, $adresse, $key));
        return $sql;
    }

    public function selectClient($email)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("SELECT * FROM client WHERE email = ?", array($email));
        $result = $sql->fetch();
        return $result;
    }

    public function updatePassword($password, $email)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("UPDATE client SET password = ? WHERE email = ?", array($password, $email));
        $result = $sql->fetch();
        return $result;
    }

    public function updateKey($newkey, $email)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("UPDATE client SET confirmkey = ? WHERE email = ?", array($newkey, $email));
        $result = $sql->fetch();
        return $result;
    }
}
