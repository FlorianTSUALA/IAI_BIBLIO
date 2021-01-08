<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       31/7/2013
 */ 

function represLine($tabGraphe, $xLabel, $range, $titre){

    $d = new hollow_dot();
    $d->size(5)->halo_size(0)->colour('#3D5C56');
    $d->size(3)->colour('#DFC329')->tooltip( '#val#' );
    
    $line = new line();
    $line->set_on_show(new line_on_show('pop-up', 2.5, 0));
    $line->set_default_dot_style($d);
    $line->set_values($tabGraphe); //tableau des valeurs exercice n
    //$line->set_text($_SESSION['periode']." ".$annee);
    $line->set_colour('#00FF40');
    
    
    $chartLine = new open_flash_chart();
    //$chartLine->set_title($title);
    $chartLine->add_element($line);
    
    //
    // create a Y Axis object
    //
    $y = new y_axis();
    // grid steps:
    //$y->set_range( -1000000, 3000000, 100);
    $y->set_range($range[0], $range[1], $range[2]);
    
    //
    // Add the Y Axis object to the chart:
    //
    $chartLine->set_y_axis( $y );
    
    
    
    //
    // create a X Axis object
    //
    
    $x = new x_axis();
    $x->set_labels_from_array($xLabel);
    $chartLine->set_x_axis( $x );
     
    
    ?> 
    
    <script type="text/javascript" src="../web/flash/js/json/json2.js"></script>
    <script type="text/javascript" src="../web/flash/js/swfobject.js"></script>
    
    <script type="text/javascript">
        swfobject.embedSWF(
           "open-flash-chart.swf", 
           "my_chartLine",
           "98%", 
           "400", 
           "9.0.0", 
           "expressInstall.swf",
          {"get-data":"get_data_Line"} );
    </script>
    
    <script type="text/javascript">
    
    function get_data_Line()
    {
        //alert( 'reading data' );
        //alert(JSON.stringify(data));
        return JSON.stringify(dataLine);
    }
    
    function findSWF(movieName) {
      if (navigator.appName.indexOf("Microsoft")!= -1) {
        return window[movieName];
      } else {
        return document[movieName];
      }
    }
        
    var dataLine = <?php echo $chartLine->toPrettyString(); ?>;
    
    </script>
    
    <div id="my_chartLine"></div>

<?php
	}
?>

