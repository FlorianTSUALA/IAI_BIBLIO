<?php

/**
 * @author lolkittens
 * @copyright 2013
 */




function pourcentage($a, $b) {
    
    $result = 0;
    
    if ($a != 0){
        $result = 100*($b/$a);
        }
    else if ($b != 0){
            $result = 100;
        }
     return $result;
}

?>