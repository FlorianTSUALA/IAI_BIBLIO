<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       31/7/2013
 */ 

function represLine($tabGraphe1, $tabGraphe2, $xLabel, $range){

    $d = new hollow_dot();
    $d->size(5)->halo_size(0)->colour('#3D5C56');
    $d->size(3)->colour('#DFC329')->tooltip( '#val#' );
    
    //annee en cours
    $line1 = new line();
    $line1->set_on_show(new line_on_show('pop-up', 2.5, 0));
    $line1->set_default_dot_style($d);
    $line1->set_values($tabGraphe1); //tableau des valeurs exercice n
    //$line1->set_text($_SESSION['periode']." ".$annee);
    $line1->set_colour('#00FF40');
    
    //année precedente
    $line2 = new line();
    $line2->set_on_show(new line_on_show('explode',2.5,0));
    $line2->set_default_dot_style($d);
    $line2->set_width( 3 );
    $line2->set_values($tabGraphe2); //tableau des valeurs exercice n-1
    //$line2->set_text($precedent[0]." ".$precedent[1]);
    $line2->set_colour('#2d89ef;');
    
    $chartLine = new open_flash_chart();
    //$chartLine->set_title($title);
    $chartLine->add_element($line1);
    $chartLine->add_element($line2);
    
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
    
    <script type="text/javascript" src="../flash/js/json/json2.js"></script>
    <script type="text/javascript" src="../flash/js/swfobject.js"></script>
    
    <script type="text/javascript">
        swfobject.embedSWF(
           "open-flash-chart.swf", 
           "my_chartLine",
           "100%", 
           "300", 
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

