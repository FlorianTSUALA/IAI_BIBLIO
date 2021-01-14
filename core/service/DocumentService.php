<?php

require_once 'DBTrait.php';

class DocumentService
{
    use DBTrait;
    
    static $table = "document";
    
    public function __construct($connexion)
    {
    }

    public static function getTable(){
        return self::$table;
    }

}