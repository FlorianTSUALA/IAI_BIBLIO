<?php

/**
 * @author THITY ADZ
 * @project CPPF
 * @copyright Avril 2019
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

if (isset($_POST['save'])) {
     //Creation du profil
     $libelle = addslashes(trim($_POST['libelle']));
     
     $sql = "INSERT INTO \"profil\" VALUES ('', '$libelle', 1)";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Creation d'un nouveau profil/groupe d'utilisateurs : $libelle");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();   
     
     header('Location: profils.php?save=1');
     exit();
}

if (isset($_GET['delete_id'])) {
    
     //Suppression du profil
     $id = $_GET['delete_id'];
     $sql = "UPDATE \"profil\" SET active = 0 WHERE id = $id";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Suppression d'un profil/groupe d'utilisateurs : id = $id");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();  
     
    header('Location: profils.php?delete=1');
    exit();
}


if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $libelle = addslashes(trim($_POST['libelle']));
     
     $sql = "UPDATE \"profil\" SET libelle = '$libelle' WHERE id = $id";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Mise a jour d'un profil/groupe d'utilisateurs : id = $id");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();  
     
     header('Location: profils.php?save=2');
     exit();
}

if (isset($_GET['update_id'])) {
    
    include('../template/entete.php'); 
    
    $id = $_GET['update_id'];
    $sql = "SELECT * FROM \"profil\" WHERE id = $id";

    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$profil = $stmt->fetch(PDO::FETCH_ASSOC);
    
?>

<div class="row">  

    <div class="col-md-12">
    
        <div class="card">
            
            <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
                <h6 class="mg-b-0 tx-14 tx-inverse">Mise à jour d'un profil</h6>
                <div class="card-option tx-24">
                    <a class="btn btn-info btn-success" href="profils.php" class="tx-gray-600 mg-l-10"><i class="fa fa-arrow-left"></i></a>
                  </div>
            </div>
            
            <div class="card-body">
            
              <form action="gestion-profils.php?update_id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                   <div class="input-group">
                     <span class="input-group-addon"><i class="icon ion-person tx-16 lh-0 op-6"></i></span>
                     <input type="text" name="libelle" required=""  class="form-control" value="<?php echo $profil['LIBELLE']; ?>" placeholder="Libellé du profil" autocomplete="off" />
                   </div>
                   <br />
                  <button type="submit" name="maj" class="btn btn-outline-primary btn-block mg-b-10 col-md-2">
                    Sauvegarder
                  </button>
                  
              </form>
            
            </div>
            
        </div>
      
    </div>

</div>    

<?php

	include('../template/pied.php');  
    
 }     

?>