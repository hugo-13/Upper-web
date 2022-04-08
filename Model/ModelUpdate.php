<?php

// Permet d'avoir le fichier nommé contact un seul fois le rendre unique 
namespace ModelUpdate;

use Core;

class ModelUpdate
{

    // Propriétées -> encapsulation (protéger les propriétées (utilisable uniquement ici))
    private $test_email;
    private $test_telephone;
    private $test_nom;
    private $confirm;
    private $user;


    public function getRegion()
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("SELECT * FROM region ORDER BY id_region ASC");
        return $sql;
    }

    public function getId($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("SELECT * from client where nom = ? ", array($nom));
        $result = $sql->fecth();
        return $result;
    }




    public function updateClient($nom, $email, $telephone, $type, $region, $adresse, $key, $confirm, $id)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact trier par date d'enregistrement
        $sql = $bdd->query("UPDATE client SET nom = ?, email = ?, telephone = ?, id_type = ?, id_region = ?, adresse = ?, confirmkey = ?, confirm = ? where id_client = ?", array($nom, $email, $telephone, $type, $region, $adresse, $key, $confirm, $id));
        return $sql;
    }




    // Voir si email = email dans la table ***************************************
    public function testDuplicataMail($email)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("SELECT * FROM client WHERE email = ?", array($email));
        $test_email = $sql->fetch();
        $this->test_email = $test_email;
    }

    // Voir si email = email dans la table ***************************************
    public function getClient($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("SELECT * FROM client LEFT JOIN type on (client.id_type = type.id_type) Inner join region on (client.id_region = region.id_region) WHERE nom = ?", array($nom));
        $client = $sql->fetch();
        return $client;
    }


    // Getter si pas trouver test = false 
    public function getTestDuplicataMail()
    {
        return $this->test_email;
    }

    // Voir si telephone = telephone dans la table *************************************
    public function testDuplicataTelephone($telephone)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("SELECT * FROM client WHERE telephone = ?", array($telephone));
        $test_telephone = $sql->fetch();
        $this->test_telephone = $test_telephone;
    }


    // Getter si pas trouver test = false 
    public function getTestDuplicataTelephone()
    {
        return $this->test_telephone;
    }




    // Voir si telephone = telephone dans la table*************************************
    public function testDuplicataNom($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("SELECT * FROM client WHERE nom = ?", array($nom));
        $test_nom = $sql->fetch();
        $this->test_nom = $test_nom;
    }


    // Getter si pas trouver test = false 
    public function getTestDuplicataNom()
    {
        return $this->test_nom;
    }




    // Voir si nom = nom dans la table*************************************
    public function userConfirm($nom)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("SELECT * FROM client WHERE nom = ?", array($nom));
        $confirm = $sql->rowCount();
        $this->confirm = $confirm;
        $user = $sql->fetch();
        $this->user = $user;
    }


    // Getter si pas trouver test = false 
    public function getConfirm()
    {
        return $this->confirm;
    }

    // Getter si pas trouver test = false 
    public function getUser()
    {
        return $this->user;
    }



    // Voir si telephone = telephone dans la table*************************************
    public function updateConfirm($nom, $key)
    {
        // Connexion a la bd
        $bdd = Core::getDatabase();
        // Lecture de toute la table contact 
        $sql = $bdd->query("UPDATE client SET confirm = 1 WHERE nom = ? AND confirmkey = ?", array($nom, $key));
    }
}
