<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       16/8/2013
 */ 


function sepMillier($val){
    return number_format($val,0,'.',' ');
}

function sepMillier2($val){
    return number_format($val,3,'.',' ');
}

function applySepMillier(array $tab){
    for ($i=0;$i<count($tab);$i++){
        $tab[$i] = sepMillier($tab[$i]);
    }
    return $tab;
}

function applySepMillier2(array $tab){
    for ($i=0;$i<count($tab);$i++){
        $tab[$i] = sepMillier2($tab[$i]);
    }
    return $tab;
}

?> 