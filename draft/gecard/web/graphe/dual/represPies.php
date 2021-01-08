<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       31/7/2013
 */ 

function represPies($tabGraphe1, $tabGraphe2,$xLabel, $range){

    $val1 = array();
    $val2 = array();
    
    for ($i=0;$i<count($tabGraphe1);$i++) {
        $val1[$i] = new pie_value($tabGraphe1[$i], $xLabel[$i]);
        $val2[$i] = new pie_value($tabGraphe2[$i], $xLabel[$i]);
    }
    
    //exercice courant
    $pie1 = new pie();
    $pie1->set_values($val1); //tableau des valeurs exercice n
    $pie1->alpha(0.5)
        ->add_animation( new pie_fade() )
        ->add_animation( new pie_bounce(5) )
        ->start_angle( 0 )
        ->tooltip( '#val# sur #total#<br> soit #percent#' )
        ->colours(array("#d01f3c","#356aa0","#C79810"));
    
    //exercice precedent
    $pie2 = new pie();
    $pie2->set_values($val2); //tableau des valeurs exercice n-1
    $pie2->alpha(0.5)
        ->add_animation( new pie_fade() )
        ->add_animation( new pie_bounce(5) )
        ->start_angle( 0 )
        ->tooltip( '#val# sur #total#<br> soit #percent# ' )
        ->colours(array("#d01f3c","#356aa0","#C79810"));
    
    $chart1 = new open_flash_chart();
    $chart2 = new open_flash_chart();
    
    $chart1->set_title($title);
    $chart2->set_title($title1);
    
    $chart1->add_element($pie1);
    $chart2->add_element($pie2);
    
     
    
    ?> 
    
    <script type="text/javascript" src="../flash/js/json/json2.js"></script>
    <script type="text/javascript" src="../flash/js/swfobject.js"></script>
    
    <script type="text/javascript">  
        swfobject.embedSWF(
          "open-flash-chart.swf", 
          "chart_1",
          "45%", 
          "300", 
          "9.0.0", 
          "expressInstall.swf",
          {"get-data":"get_data_1"} );
     
        swfobject.embedSWF(
          "open-flash-chart.swf", 
          "chart_2",
          "45%", 
          "300", 
          "9.0.0", 
          "expressInstall.swf",
          {"get-data":"get_data_2"} );
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
    
    function get_data_1()
    {
        //alert( 'reading data' );
        //alert(JSON.stringify(data));
        return JSON.stringify(data1);
    }
    
    function get_data_2()
    {
        //alert( 'reading data' );
        //alert(JSON.stringify(data));
        return JSON.stringify(data2);
    }
    
    function findSWF(movieName) {
      if (navigator.appName.indexOf("Microsoft")!= -1) {
        return window[movieName];
      } else {
        return document[movieName];
      }
    }
        
    var data1 = <?php echo $chart1->toPrettyString(); ?>;
    var data2 = <?php echo $chart2->toPrettyString(); ?>;
    
    </script>
    
    <div id="chart_1"></div>
    <div id="chart_2"></div>


<?php
	}
?>
