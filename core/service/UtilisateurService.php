
<?php

require_once("core/Helper/DBHelper.php");
require_once("config/config.php");
 
class UtilisateurService
{
    static $table = "utilisateur";

    public function __construct($connexion)
    {
    }

    public static function getAll(){
        return DBHelper::getAll(self::$table);
    }

    public static function getCount(){
        return DBHelper::getCount(self::$table);
    }

    public static function delete($id){
        return DBHelper::delete(self::$table, $id);
    }
    
    public static function insert($data){
        return DBHelper::insert(self::$table, $data);
    }

    public static function update($id, $data){
        return DBHelper::update(self::$table, $id, $data);        
    }

}