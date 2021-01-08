<?php 

    require('../include/admin/header-admin.php');
    require("../include/admin/nav-admin.php");
    require("../include/admin/aside-admin.php");
    require("../config/config.php");

?>


            <?php
                $sql = "SELECT * FROM document WHERE id={$_GET['id']}; ";

                $requete = $connexion->prepare($sql);
                $requete->execute();
                $document = $requete->fetch();
  
                $id = $document["id"];
                $theme = $document["theme"];
                $etudiant = $document["etudiant"];
                $structure_accueil = $document["structure_accueil"];
                $liste_mots_cles = $document["liste_mots_cles"];
                $note_obtenue = $document["note_obtenue"];
                $annee_academ = $document["annee_academ"];
                $id_cycle = $document["id_cycle"];
                $id_superviseur = $document["id_superviseur"];
            ?>


<section class="content">
      <div class="container-fluid">
        <h3>Ajout un Document</h3>
	    
        <form  action="gerer-document.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'], ENT_QUOTES) ?>" />
           

            <table class="table">
            
				<tr>
					<td>theme</td>
					<td><input type="text" name="theme" value="<?= $theme;?>" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>structure_accueil</td>
					<td><input type="text" name="structure" required="" value="<?= $structure_accueil;?>" class="form-control" /></td>
				</tr>
				<tr>
					<td>cycle</td>
					<td><select name="cycle" >

							<?php
                                $sql = "select * from cycle";
                                $requete = $connexion->prepare($sql);
                                $requete->execute();
                                $cycles = $requete->fetchAll();

                                foreach ($cycles as $cycle) {
                                    if($cycle['id'] == $id_cycle)
                                        echo "<option value={$cycle['id']} required='' class='form-control' selected>{$cycle['libelle']}</option>";
                                    else    
                                        echo "<option value={$cycle['id']} required='' class='form-control'>{$cycle['libelle']}</option>";
                                }
							?>

						</select>
					</td>

				</tr>
				<tr>
					<td>nom de l'etudiant</td>
					<td><input type="text" name="etudiant" required="" value="<?= $etudiant;?>" class="form-control" /></td>
				</tr>
				<tr>
					<td>mots cles</td>
					<td><input type="textarea" name="mots" required="" value="<?= $liste_mots_cles;?>" class="form-control" /></td>
				</tr>
				<tr>
					<td>note obtenue</td>
					<td><input type="number" name="note" required="" value="<?= $note_obtenue;?>" class="form-control" /></td>
				</tr>
				<td>Superviseur</td>
				<td><select name="superviseur">
						<?php
                            require_once("../config/config.php");
                            $sql = "select * from enseignant";
                            $requete = $connexion->prepare($sql);
                            $requete->execute();
                            $Superviseurs = $requete->fetchAll();

                            foreach ($Superviseurs as $Superviseur) {
                                if($element == $$id_superviseur)
                                        echo "<option value={$Superviseur['id']} required='' class='form-control' selected>{$Superviseur['nom_prenom']}</option>";
                                    else    
                                        echo "<option value={$Superviseur['id']} required='' class='form-control'>{$Superviseur['nom_prenom']}</option>";
                            }
						?>
					</select>
				</td>
				<tr>
					<td>Annee Academique</td>
					<td><input type="text" name="annee_acc" required="" value="<?= $annee_academ;?>"  class="form-control" /></td>
				</tr>
				<tr>
					<td>img_couv</td>
					<td><input type="file" name="img_couv"  class="form-control" /></td>
				</tr>
				<tr>
					<td>fichier</td>
					<td><input type="file" name="fichier" accept=".pdf" class="form-control" /></td>
				</tr>
				

				<td><input type="submit" name="modifier" value="enregistrer" class="btn btn-primary" /></td>
				<td><a href="liste-document.php" class="btn btn-warning">Retour</a></td>
          </table>

  
        </form>
    </div>
</section>

  <?php require('../include/admin/footer-admin.php')?>