<?php

require_once("core/Helper/DBHelper.php");
require_once("config/config.php");

trait DBTrait{
    

    public static function getTable(){
        return "";
    }

    public static function getAll(){
        return DBHelper::getAll(self::getTable());
    }

    public static function getLast($total){
        return DBHelper::getLast(self::getTable(), $total);
    }

    public static function getCount(){
        return DBHelper::getCount(self::getTable());
    }

    public static function delete($id){
        return DBHelper::delete(self::getTable(), $id);
    }
    
    public static function insert($data){
        return DBHelper::insert(self::getTable(), $data);
    }

    public static function update($id, $data){
        return DBHelper::update(self::getTable(), $id, $data);        
    }

    public static function sort($critere, $parametre){
        return DBHelper::sort(self::getTable(), $critere, $parametre);        
    }

    public static function sortBy($critere, $parametre, $field, $mot_cle){
        return DBHelper::sortBy(self::getTable(), $critere, $parametre, $field, $mot_cle);        
    }

    public static function execSelectOne($sql){
        return DBHelper::execSelectOne($sql);        
    }

 

}