<?php

/**
 * @author Thity Ouss @
 * @copyright 2012
 * @date      12/12/2012 
 */



class datefr
{
  private $semaine;
  private $mois;
  
  function __construct(){
    $this->semaine = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    $this->mois    = array(1=>"Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
  }
  
  public function getDateNow() {
  $timestamp=time();
  $chdate= $this->semaine[date('w',$timestamp)] ." ".date('d',$timestamp)." ".$this->mois[date('n',$timestamp)]." ".date('Y',$timestamp);
  return $chdate;
  }
  
  public function getDateLater($njour) {
  $timestamp=time() + $njour*24*3600;
  $chdate= $this->semaine[date('w',$timestamp)] ." ".date('d',$timestamp)." ".$this->mois[date('n',$timestamp)]." ".date('Y',$timestamp);
  return $chdate;
  }
  
  public function getMoisNow(){
    return self::$mois[date('m',time())];
  }
  
  public function getJourNow(){
    return $this->semaine[date('w',time())];
  }
  
  public static function getYearNow(){
    return date('Y',time());
  }
  
    
}
?>