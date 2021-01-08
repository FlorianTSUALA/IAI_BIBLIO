<?php

/**
 * @author THITY ADZ
 * @project Gestion de parc automobile
 * @copyright 10/2/2014
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');


if (isset($_GET['detail_pj'])) {
    
    $id = $_GET['detail_pj'];
    
    $table = Doctrine_Core::getTable('Archive');
    $archive = $table->find($id); 
    
?>    

<legend>Aper&ccedil;u du document</legend>


<iframe src="<?php echo $archive['document']; ?>" width="400" height="400"></iframe>



<?php

}

if (isset($_GET['delete_id'])) {
    
    $id = $_GET['delete_id'];
    
    $table = Doctrine_Core::getTable('Archive');
    $archive = $table->find($id);   
    $archive->delete();
    
    header('Location: recherches.php?delete=1');
    exit();
}


?>