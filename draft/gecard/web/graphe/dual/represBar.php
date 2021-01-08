<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       31/7/2013
 */ 



function represBar($tabGraphe1, $tabGraphe2, $xLabel, $range){

    //annee en cours
    $bar1 = new bar_cylinder_outline();
    $bar1->set_on_show(new bar_on_show('grow-up', 2.5, 0));
    $bar1->set_values($tabGraphe1); //tableau des valeurs exercice n
    //$bar1->set_text($_SESSION['periode']." ".$annee);
    $bar1->set_colour('black');
    
    //année precedente
    $bar2 = new bar_cylinder_outline();
    $bar2->set_on_show(new bar_on_show('grow-up',2.5,0));
    $bar2->set_values($tabGraphe2); //tableau des valeurs exercice n-1
    $bar2->set_text($precedent[0]." ".$precedent[1]);
    $bar2->set_colour('green');
    
    $chartBar = new open_flash_chart();
    //$chartBar->set_title($title);
    $chartBar->add_element($bar1);
    $chartBar->add_element($bar2);
    
    //
    // create a Y Axis object
    //
    $y = new y_axis();
    // grid steps:
    $y->set_range($range[0], $range[1], $range[2]);
    //$y->set_range( -1000000, 3000000, 100);
    
    //
    // Add the Y Axis object to the chart:
    //
    $chartBar->set_y_axis( $y );
    
    
    //
    // create a X Axis object
    //
    
    $x = new x_axis();
    $x->set_labels_from_array($xLabel);
    $chartBar->set_x_axis( $x );
    
    ?> 
    
    <script type="text/javascript" src="../flash/js/json/json2.js"></script>
    <script type="text/javascript" src="../flash/js/swfobject.js"></script>
    
    <script type="text/javascript">
        swfobject.embedSWF(
           "open-flash-chart.swf", 
           "my_chartBar",
           "100%", 
           "300", 
           "9.0.0", 
           "expressInstall.swf",
          {"get-data":"get_data_Bar"} 
        );
    </script>
    
    <script type="text/javascript">
    
    function get_data_Bar()
    {
        //alert( 'reading data' );
        //alert(JSON.stringify(data));
        return JSON.stringify(dataBar);
    }
    
    function findSWF(movieName) {
      if (navigator.appName.indexOf("Microsoft")!= -1) {
        return window[movieName];
      } else {
        return document[movieName];
      }
    }
        
    var dataBar = <?php echo $chartBar->toPrettyString(); ?>;
    
    </script>
    
    
    <div id="my_chartBar"></div>

<?php
	}
?>

