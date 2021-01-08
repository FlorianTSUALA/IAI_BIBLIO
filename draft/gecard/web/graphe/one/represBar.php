<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       31/7/2013
 */ 



function represBar($tabGraphe, $xLabel, $range, $titre){

    $bar = new bar_cylinder();
    $bar->set_on_show(new bar_on_show('grow-up', 2.5, 0));
    $bar->set_values($tabGraphe); 
    $bar->set_tooltip('#val# '.$titre);
    
    
    $chartBar = new open_flash_chart();
    $chartBar->add_element($bar);

    //
    // create a Y Axis object
    //
    $y = new y_axis();
    // grid steps:
    $y->set_range($range[0], $range[1], $range[2]);
    
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
    
    <script type="text/javascript" src="../web/flash/js/json/json2.js"></script>
    <script type="text/javascript" src="../web/flash/js/swfobject.js"></script>
    
    <script type="text/javascript">
        swfobject.embedSWF(
           "open-flash-chart.swf", 
           "my_chartBar",
           "98%", 
           "400", 
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

