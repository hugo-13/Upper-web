<?php

// Permet d'avoir le fichier nommé contact un seul fois le rendre unique
namespace ModelContact;

use Core;

class ModelContact
{
    // Propriétées -> encapsulation (protéger les propriétées (utilisable uniquement ici))
    private $test_email;
    private $test_telephone;

    // Ajouter les donné a la table 
    public function addContact($email, $telephone, $objet, $message)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Insertion des donné dans la table 
        $sql = $bdd->query("INSERT INTO contact (email, telephone, objet, message) VALUES (?,?,?,?)", array($email, $telephone, $objet, $message));
    }


    // Voir si email = email dans la table 
    public function testDuplicataMail($email)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("SELECT * FROM contact WHERE email = ?", array($email));
        $test_email = $sql->fetch();
        $this->test_email = $test_email;
    }


    // Getter si pas trouver test = false 
    public function getTestDuplicataMail()
    {
        return $this->test_email;
    }

    // Voir si telephone = telephone dans la table 
    public function testDuplicataTelephone($telephone)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("SELECT * FROM contact WHERE telephone = ?", array($telephone));
        $test_telephone = $sql->fetch();
        $this->test_telephone = $test_telephone;
    }


    // Getter si pas trouver test = false 
    public function getTestDuplicataTelephone()
    {
        return $this->test_telephone;
    }
}
