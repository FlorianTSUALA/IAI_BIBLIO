<?php

/**
 * @author THITY ADZ
 * @project CPPF
 * @copyright Avril 2019
 */

session_start();

require_once(dirname(__FILE__).'/../config/global.php');

if (isset($_POST['save'])) {
     //Creation utilisateur
     $nom = addslashes(trim($_POST['nom']));
     $prenom = addslashes(trim($_POST['prenom']));
     
     $sexe = $_POST['sexe'];
     $id_profil = $_POST['id_profil'];
     
     $login = $_POST['login'];
     $password = md5($_POST['password']);
     
     $created_at = date('Y-m-d H:i:s');
     
     $sql = "INSERT INTO \"utilisateur\" VALUES ('', '$nom', '$prenom', '$sexe', 1, '$login', '$password', $id_profil, '$created_at')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Creation d'un nouvel utilisateur : $nom $prenom");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();   
     
     header('Location: utilisateurs.php?save=1');
     exit();
}

if (isset($_GET['delete_id'])) {
    
     //Suppression du profil
     $id = $_GET['delete_id'];
     $sql = "UPDATE \"utilisateur\" SET active = 0 WHERE id = $id";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Suppression d'un utilisateur : id = $id");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();  
     
    header('Location: utilisateurs.php?delete=1');
    exit();
}


if (isset($_POST['maj'])) {
    
     $id = $_GET['update_id'];
     $sql = "SELECT * FROM \"utilisateur\" WHERE id = $id";
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
     $nom = addslashes(trim($_POST['nom']));
     $prenom = addslashes(trim($_POST['prenom']));
     
     $sexe = $_POST['sexe'];
     $id_profil = $_POST['id_profil'];
     
     $login = $_POST['login'];
     $password = ($_POST['password'] != '' ? md5($_POST['password']) : $utilisateur['PASSWORD']);
     
     $created_at = date('Y-m-d H:i:s');
     
     $sql = "UPDATE \"utilisateur\" SET nom = '$nom',
                                    prenom = '$prenom',
                                    sexe = '$sexe',
                                    login = '$login',
                                    password = '$password',
                                    id_profil = '$id_profil',
                                    created_at = '$created_at'
                                     
             WHERE id = $id";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();
     
     //Enregistrements Logs
     $date_event = date('Y-m-d H:i:s');
     $id_user = $_SESSION['user_log'];
     $action = addslashes("Mise a jour d'un utilisateur : id = $id");
          
     $sql = "INSERT INTO \"logs\" VALUES ('', '$date_event', $id_user, '$action')";
     $stmt = $connexion->prepare($sql);
	 $stmt->execute();  
     
     header('Location: utilisateurs.php?save=2');
     exit();
}

if (isset($_GET['update_id'])) {
    
    include('../template/entete.php'); 
    
    $id = $_GET['update_id'];
    
    $sql = "SELECT *
            FROM \"utilisateur\"
            WHERE id = $id";
    $stmt = $connexion->prepare($sql);
	$stmt->execute();
	$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    
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
            
              <form action="gestion-utilisateurs.php?update_id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                   
                  <div class="row mg-b-25">
                   
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">Nom: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" name="nom" value="<?php echo $utilisateur['NOM'] ?>"  placeholder="Entrer le nom..." />
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label">Prénom: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" name="prenom" value="<?php echo $utilisateur['PRENOM'] ?>" placeholder="Entrer le prénom..." />
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="form-control-label">Sexe: <span class="tx-danger">*</span></label>
                            </div>
                            <div class="col-lg-3">
                                <label class="rdiobox">
                                    <input type="radio" value="Masculin" name="sexe" <?php echo ($utilisateur['SEXE'] == 'Masculin' ? 'checked=""' : "") ?> /> <span>Masculin</span>
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label class="rdiobox">
                                    <input type="radio" value="Feminin" name="sexe" <?php echo ($utilisateur['SEXE'] == 'Feminin' ? 'checked=""' : "") ?> /> <span>Feminin</span>
                                </label>
                            </div>
                        </div>
                      </div>
                      
                      <?php
	                       $sql = "SELECT *
                                    FROM \"profil\" 
                                    WHERE active = 1
                                    ORDER BY id ASC";
                        
                            $stmt = $connexion->prepare($sql);
                        	$stmt->execute();
                        	$profil = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                      <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Profil: <span class="tx-danger">*</span></label>
                          <select class="form-control" name="id_profil">
                                <?php 
                                    foreach($profil as $profil) {
                                        $id = $profil['ID'];
                                        $libelle = $profil['LIBELLE'];
                                        
                                        $selected =  ($utilisateur['id_profil'] == $id ? 'selected' : '');
                                        echo "<option value='$id' $selected>$libelle</option>";
                                    }
                                ?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Login: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" name="login" value="<?php echo $utilisateur['LOGIN'] ?>" placeholder="Entrer le login...." />
                        </div>
                      </div>
                      
                      <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Mot de passe: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="password" name="password" placeholder="Entrer le nouveau mot de passe..." />
                        </div>
                      </div>
                      
                      
                    </div>
                    
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