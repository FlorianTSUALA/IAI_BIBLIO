<?php

// entrer une date au format 2011-01-31 (Y-m-d)
function date_in_french ($date){
    $week_name = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
    $month_name=array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août",
    "Septembre","Octobre","Novembre","Décembre");

    $split = preg_split('/-/', $date);
    $year = $split[0];
    $month = round($split[1]);
    $day = round($split[2]);

    $week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
    return $date_fr = $week_name[$week_day] .' '. $day .' '. $month_name[$month] .' '. $year;
}


function date_french(){
    return date_in_french(date('Y-m-d'));
}



function heure(){
    return date('H:i');
}