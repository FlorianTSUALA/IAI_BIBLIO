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
            case "document-list":     $name = "document-list";   break;
            case "document-detail":      $name = "consultation";   break;
            case "document-add":      $name = "";   break;
            case "document-controller":      $name = "document-controller";   break;

            case "cycle":      $name = "cycle";   break;
            case "cycle-list":     $name = "";   break;
            case "cycle-add":      $name = "";   break;
            case "cycle-controller":      $name = "cycle-controller";   break;

            case "enseignant":      $name = "enseignant";   break;
            case "enseignant-list":     $name = "";   break;
            case "enseignant-add":      $name = "";   break;
            case "enseignant-controller":      $name = "enseignant-controller";   break;

            case "utilisateur":      $name = "utilisateur";   break;
            case "utilisateur-list":     $name = "";   break;
            case "utilisateur-add":      $name = "";   break;
            case "utilisateur-controller":      $name = "utilisateur-controller";   break;
            
            case "contact":       $name = "contact";   break;
            case "apropos":       $name = "apropos";   break;
            case "accueil":       $name = "index";   break;
            case "connexion":     $name = "connexion";   break;
            case "deconnexion":     $name = "deconnexion";   break;
            case "inscription":       $name = "";   break;
            default:      $name = "404";
        }
        return $url.$name.".php";
    }


    public static function img($name){
        return BASE_URL."media/IMG/".$name;
    }

    public static function pdf($name){
        return BASE_URL."media/PDF/".$name;
    }

    public static function res(){
        
    }

}