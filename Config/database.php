<?php

class Database
{

    private $bdd;
    private $erreur_requete;

    public function __construct($user, $password, $db_name, $host = 'mysql-upper.alwaysdata.net')
    {
        try {
            // Connexion bd 
            $this->bdd = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
            // set the PDO error mode to exception
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public function query($query, $param = array())
    {
        // initialisation de erreur 
        $erreur_requete = array();

        try {
            if ($param) {
                // Condition 
                $sql = $this->bdd->prepare($query);
                $sql->execute($param);
            } else {
                // Condition 

                $sql = $this->bdd->prepare($query);
                $sql->execute();
            }

            return $sql;
        } catch (PDOException $e) {
            //SI IL Y A UNE ERREUR L'ENSEMBLE DES REQUETES EST ANNULEE ON REVIENT A L'ETAT INITIAL
            $this->bdd->beginTransaction();
            // $this->bdd->rollBack();
            //GESTION DES ERREURS
            $erreur =  "--ERREUR REQUETE LE " . date("d/m/y H:i:s") . "--\n";
            $erreur = $erreur . "[FICHIER] : " . $e->getFile() . "\n";
            $erreur = $erreur . "[LIGNE] : " . $e->getLine() . "\n";
            $erreur = $erreur . "[CODE] : " . $e->getCode() . "\n";
            $erreur = $erreur . "[MESSAGE] : " . $e->getMessage() . "\n";
            // LA NOTATION .= revient a la meme chose qu'au dessus
            $erreur .=  "[IP USER] : " . $_SERVER['REMOTE_ADDR'] . "\n";
            historisation("log", "erreur_requete", $erreur);
            //ERREUR POUR L'ECRAN USER
            echo "<div style='margin-top: 100px; margin-left:10px; color:red; font-weight:700;'>UNE ERREUR EST SURVENUE **</div>";
        }
    }
}
