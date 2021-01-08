<?php

/**
 * @author lolkittens
 * @copyright 2018
 */


session_start();
//header("Cache-Control: no-cache");


if (isset($_GET['val'])) {
    
    if ($_GET['val'] == 'seb') {
        
       //echo dirname(__FILE__)."/documents/".$_SESSION['lib_seb'];
       
       if (!file_exists("../documents/".$_SESSION['lib_seb'])){
    		echo "<script>alert('file doesnt exists !!!'); history.go(-1);</script>";
    		return;
    	}
        
        $tab = explode('.', $_SESSION['lib_seb']);
        
        if ($tab[1] == 'pdf') {
            
        
        ?>
        
        
        <div style="background-color: gray;">
        
            <embed  width="100%" 
                    height="100%" 
                    name="plugin" 
                    src="<?php echo "../documents/".utf8_encode($_SESSION['lib_seb']); ?>" 
                    type="application/pdf" />
        
        </div>
            
        <?php
        
            }
            else {
                
                ?>
                
                <iframe src="<?php echo "../documents/".utf8_encode($_SESSION['lib_seb']); ?>">
                    
                </iframe>
                <br /><h3>Fichier g&eacute;n&eacute;r&eacute; et t&eacute;l&eacute;charg&eacute; avec succ&egrave;s....</h3>
                <?php
    	
            }
    }
    
    else if ($_GET['val'] == 'bal') {
        
        //echo dirname(__FILE__)."/documents/".$_SESSION['lib_balance'];
        
        if (!file_exists("../documents/".$_SESSION['lib_balance'])){
    		echo "<script>alert('file doesnt exists !!!'); history.go(-1);</script>";
    		return;
    	}
    ?>
    
    
    <div style="background-color: gray;">
    
        
        <embed  width="100%" 
                height="100%" 
                name="plugin" 
                src="<?php echo "../documents/".utf8_encode($_SESSION['lib_balance']); ?>" 
                type="application/pdf" />
        
    
    </div>
        
    <?php
    	}
        else if ($_GET['val'] == 'recette') {
        
        //echo $_SESSION['lib_recette'];
        
        if (!file_exists("../documents/".$_SESSION['lib_recette'])){
    		echo "<script>alert('file doesnt exists !!!'); history.go(-1);</script>";
    		return;
    	}
    ?>
    
    
    <div style="background-color: gray;">
    
        
        <embed  width="100%" 
                height="100%" 
                name="plugin" 
                src="<?php echo "../documents/".utf8_encode($_SESSION['lib_recette']); ?>" 
                type="application/pdf" />
        
    
    </div>
        
    <?php
    	}
        else if ($_GET['val'] == 'fc') {
        
        //echo dirname(__FILE__)."/documents/".$_SESSION['lib_fc'];
        
        if (!file_exists("../documents/".$_SESSION['lib_fc'])){
    		echo "<script>alert('file doesnt exists !!!'); history.go(-1);</script>";
    		return;
    	}
    ?>
    
    
    <div style="background-color: gray;">
    
        
        <embed  width="100%" 
                height="100%" 
                name="plugin" 
                src="<?php echo "../documents/".utf8_encode($_SESSION['lib_fc']); ?>" 
                type="application/pdf" />
        
    
    </div>
        
    <?php
    	}
        
        else if ($_GET['val'] == 'menc') {
        
        //echo dirname(__FILE__)."/documents/".$_SESSION['lib_menc'];
        
        if (!file_exists("../documents/".$_SESSION['lib_menc'])){
    		echo "<script>alert('file doesnt exists !!!'); history.go(-1);</script>";
    		return;
    	}
    ?>
    
    
    <div style="background-color: gray;">
    
        
        <embed  width="100%" 
                height="100%" 
                name="plugin" 
                src="<?php echo "../documents/".utf8_encode($_SESSION['lib_menc']); ?>" 
                type="application/pdf" />
        
    
    </div>
        
    <?php
    	}
        
        else if ($_GET['val'] == 'etatfi') {
        
        //echo dirname(__FILE__)."/documents/".$_SESSION['lib_etat'];
        
        if (!file_exists("../documents/".$_SESSION['lib_etat'])){
    		echo "<script>alert('file doesnt exists !!!'); history.go(-1);</script>";
    		return;
    	}
    ?>
    
    
    <div style="background-color: gray;">
    
        
        <embed  width="100%" 
                height="100%" 
                name="plugin" 
                src="<?php echo "../documents/".utf8_encode($_SESSION['lib_etat']); ?>" 
                type="application/pdf" />
        
    
    </div>
        
    <?php
    	}
        
     }
     else {
        return ;
     }
?>
    