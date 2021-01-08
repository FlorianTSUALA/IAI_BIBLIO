<?php


/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       13/9/2013
 */ 

class Logs {
    
    private $user;
    private $observation;
    
    public function __construct($user,$observation){
        $this->user = $user;
        $this->observation = $observation;
    }
    
    
    public function addLog($pathDir){  
    
    if (!$fp = fopen($pathDir."logs.txt","a")) {
        echo "Echec de l'ouverture du fichier";
    }
    else {
            $logs = date('d-m-Y H:i:s')."    ".$this->user."    ".$this->observation."\r\n";
            fputs($fp,$logs);
            fclose($fp);
        } 
    }
     
     
}

?> 