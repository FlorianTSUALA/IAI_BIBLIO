<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       31/7/2013
 */ 

function represPies($tabGraphe, $xLabel, $range, $titre){

    $val = array();
    for ($i=0;$i<count($tabGraphe);$i++) {
        $val[$i] = new pie_value($tabGraphe[$i], $xLabel[$i]);
    }
    
    $pie = new pie();
    $pie->set_values($val); //tableau des valeurs exercice n
    $pie->alpha(0.5)
        ->add_animation( new pie_fade() )
        ->add_animation( new pie_bounce(5) )
        ->start_angle( 0 )
        ->tooltip( '#val# '.$titre.' sur #total#<br> soit #percent#' )
        ->colours(array("#d01f3c","#356aa0","#C79810"));
    
    
    $chart = new open_flash_chart();
    //$chart->set_title($title);
    $chart->add_element($pie);
    
    ?> 
    
    <script type="text/javascript" src="../web/flash/js/json/json2.js"></script>
    <script type="text/javascript" src="../web/flash/js/swfobject.js"></script>
    
    <script type="text/javascript">  
        swfobject.embedSWF(
          "open-flash-chart.swf", 
          "chart",
          "98%", 
          "400", 
          "9.0.0", 
          "expressInstall.swf",
          {"get-data":"get_data"} );
    </script>
    
    <script type="text/javascript">
    
    function ofc_ready()
    {
        //alert('ofc_ready');
    }
    
    function open_flash_chart_data()
    {
        //alert( 'reading data' );
        //alert(JSON.stringify(data));
        return JSON.stringify(data);
    }
    
    function get_data()
    {
        //alert( 'reading data' );
        //alert(JSON.stringify(data));
        return JSON.stringify(data);
    }
    
    function findSWF(movieName) {
      if (navigator.appName.indexOf("Microsoft")!= -1) {
        return window[movieName];
      } else {
        return document[movieName];
      }
    }
        
    var data = <?php echo $chart->toPrettyString(); ?>;
    
    </script>
    
    <div id="chart"></div>


<?php
	}
?>
