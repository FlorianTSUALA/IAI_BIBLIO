<?php

/**
 * @author lolkittens
 * @copyright 2018
 */


session_start();


    if (isset($_GET['id_archive'])) {
    
        $archive = Doctrine_Core::getTable('Archive')->find($_GET['id_archive']);

?>


    <div style="background-color: gray;">
        
        <embed  width="100%" 
                height="100%" 
                name="plugin" 
                src="<?php echo $archive->fichier; ?>" 
                type="application/pdf" />
        
    
    </div>
    
<?php  
    }
    else if (isset($_GET['val'])) {

?>


    <div style="background-color: gray;">
        
        <embed  width="100%" 
                height="100%" 
                name="plugin" 
                src="../archives/<?php echo $_GET['val']; ?>" 
                type="application/pdf" />
        
    
    </div>
    
<?php 
       
    }
?>