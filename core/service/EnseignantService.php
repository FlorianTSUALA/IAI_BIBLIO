<?php

require_once 'DBTrait.php';

class EnseignantService
{
    use DBTrait;
    
    static $table = "enseignant";

    public function __construct($connexion)
    {
    }

    public static function getTable(){
        return self::$table;
    }

}