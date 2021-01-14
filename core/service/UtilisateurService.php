
<?php

require_once 'DBTrait.php';

class UtilisateurService
{
    use DBTrait;
 
    static $table = "utilisateur";

    public function __construct($connexion)
    {
    }

    public static function getTable(){
        return self::$table;
    }


    public static function deconnexion(){
        session_start();
        unset($_SESSION["id"]);
        unset($_SESSION["nom_prenom"]);
        unset($_SESSION["login"]);
        header("Location: ".URL::link("accueil"));
    }

    public static function connexion($login, $password){
        session_start();
        $sql = "select * from utilisateur where login=:login and password=:password;";
        $req = DBHelper::connexion()->prepare($sql);
        
        $req->bindParam(":login", $login);
        $req->bindParam(":password", $password);
        
        $req->execute();
        $result = $req->fetch();
        $row = $req->rowCount();
        
        if($row == 1){
            $_SESSION["id"] = $result['id'];
            $_SESSION["login"] = $result['login'];
            $_SESSION["nom_prenom"] = $result['nom_prenom'];
            
            header("Location:".URL::link("accueil"));
        }else{
            header("Location:".URL::link("connexion")."?message=erreur_connexion");
        }
    }

    public static function checkActive(){
        return isset($_SESSION["id"]);
    }

    public static function get($tag){
        return $_SESSION[$tag];
    }

}