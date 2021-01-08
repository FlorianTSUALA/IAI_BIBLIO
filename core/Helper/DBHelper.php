<?php

require_once("config/config.php");

class DBHelper {

  static $DEBUG = true;
  private static $instance = null;
  private $conn;
  
  private $host = HOST;
  private $user = USER;
  private $pass = PASSWORD;
  private $name = DBNAME;
   
  private function __construct()
  {

    $lien_db = "mysql:host={$this->host};dbname={$this->name}";

    try {
      
      $this->conn = new PDO($lien_db, $this->user,$this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));  
      
      if(self::$DEBUG){
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      }
    } catch (PDOException $e) {
        die("Echec connexion: ".$e->getMessage());
    }

  }
  
  public static function getInstance()
  {
    if(!self::$instance){
      self::$instance = new DBHelper();
    }
   
    return self::$instance; 
  }
  
  public function getConnection()
  {
    return $this->conn;
  }

  public static function connexion(){
    return DBHelper::getInstance()->getConnection();
  }

  public static function prepare($sql){
    var_dump($sql);
    return DBHelper::getInstance()->getConnection()->prepare($sql);
  }

//DB Function utility for Generic CRUD

  public static function sort($table, $critere, $parametre){
    $sql = "select * from {$table} order by {$critere} {$parametre};";
    $req = DBHelper::connexion()->prepare($sql);
    $req->execute();
    $documents = $req->fetchAll();
    return $documents;
  }

  public static function getAll($table){
    $sql = "select * from {$table} order by date_modification desc;";
    $req = DBHelper::connexion()->prepare($sql);
    $req->execute();
    $documents = $req->fetchAll();
    return $documents;
  }

public static function getCount($table){
    $sql = "select count(*) as total from {$table};";
    $req = DBHelper::connexion()->prepare($sql);
    $req->execute();
    $result = $req->fetch();
    return $result['total'];
}

public static function delete($table, $id){
    if ($id) {
        $sql = "delete from {$table} where id={$_GET["id"]};";
        $req = DBHelper::connexion()->prepare($sql);
        $statut =$req->execute();
        return $statut;
    }
}

public static function insert($table, $data){
    $str_val = "";
    $str_label = "";
    foreach($data as $key => $value){
        $str_label .= "{$key},";
        $str_val .= ":{$key},";
    }
    $str_label = substr($str_label, 0, -1);
    $str_val = substr($str_val, 0, -1);

    $sql = "insert into {$table} ({$str_label}) values ({$str_val});";

    $req = DBHelper::prepare($sql);
    
    foreach($data as $key => $value){
        $req->bindParam(":{$key}", $value);
    }
    $statut = $req->execute(); 
    return $statut;
}

public static function update($table, $id, $data){
    $str_query = "";
    foreach($data as $key => $value){
        $str_query .= "{$key}=:{$key},";
    }
    $str_query = substr($str_query, 0, -1);

    $sql = "update {$table} set {$str_query} where id=$id";
    
    $req = DBHelper::prepare($sql);

    foreach($data as $key => $value){
        $req->bindParam(":{$key}", $value);
    }

    $statut = $req->execute(); 
    return $statut;
}

  // OTHER USABLE FUNCTION
  //protect against SQL injection attacks
  
  /*public function antisql($data)
  {
    if (is_array($data))
    {
      foreach ($data as $name=>$value)
      {
         $data[$name] = mysql_real_escape_string($value);
      }
      }
      else
      {
        $data = mysql_real_escape_string($data);
      }
    return $data;
  }*/
  
}