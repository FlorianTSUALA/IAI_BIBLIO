
<?php
 
 require_once 'DBTrait.php';

class CycleService
{
    use DBTrait;

    static $table = "cycle";

    public function __construct($connexion)
    {
    }
    
    public static function getTable(){
        return self::$table;
    }

}