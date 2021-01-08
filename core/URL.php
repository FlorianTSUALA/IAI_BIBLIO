<?php

class URL{
    
    const PAGE_HOME = ROOT_URL ;
    const PAGE_GES = ROOT_URL."gestion/";
    const PAGE_GES_DOC = URL::PAGE_GES."document";
    const PAGE_GES_CYC = URL::PAGE_GES."cycle";
    const PAGE_GES_UTI = URL::PAGE_GES."utilisateur";
    const PAGE_GES_ENS = URL::PAGE_GES."enseignant";
    const PAGE_DOC = ROOT_URL."recherche/";
    const PAGE_DET = ROOT_URL."detail/";


    public static function link($name){
        $url = BASE_URL;
        $tmp = "";
        switch($name){
            case "document":      $name = "document";   break;
            case "document-list":     $name = "";   break;
            case "document-add":      $name = "";   break;
            case "document-controller":      $name = "cycle-controller";   break;

            case "cycle":      $name = "cycle";   break;
            case "cycle-list":     $name = "";   break;
            case "cycle-add":      $name = "";   break;
            case "cycle-controller":      $name = "cycle-controller";   break;

            case "enseignant":      $name = "enseignant";   break;
            case "enseignant-list":     $name = "";   break;
            case "enseignant-add":      $name = "";   break;
            case "enseignant-controller":      $name = "cycle-controller";   break;

            case "utilisateur":      $name = "utilisateur";   break;
            case "utilisateur-list":     $name = "";   break;
            case "utilisateur-add":      $name = "";   break;
            case "utilisateur-controller":      $name = "cycle-controller";   break;
            
            case "contact":       $name = "contact";   break;
            case "apropos":       $name = "apropos";   break;
            case "accueil":       $name = "accueil";   break;
            case "connexion":     $name = "connexion";   break;
            case "inscription":       $name = "";   break;
            default:      $name = "404";
        }
        return $url.$name.".php";
    }

    public static function path(){

    }

}