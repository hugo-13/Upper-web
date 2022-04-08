<?php 

class Core{
    static $bdd;

    static function getDatabase(){

        if(!self::$bdd){
            return new Database('upper','fordfiestaW8', 'upper_web');
        }
        return self::$bdd;
    }
}