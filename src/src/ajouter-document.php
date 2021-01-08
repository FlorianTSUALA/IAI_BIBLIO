<?php 

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php") 

?>

<section class="content">
	<div class="container-fluid">
		<h3>Ajout un Document</h3>
		<form action="gerer-document.php" method="POST" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td>theme</td>
					<td><input type="text" name="theme" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>structure_accueil</td>
					<td><input type="text" name="structure" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>cycle</td>
					<td><select name="cycle">

							<?php
							require("../config/config.php");
							$sql = "select * from cycle";
							$requete = $connexion->prepare($sql);
							$requete->execute();
							$cycles = $requete->fetchAll();

							foreach ($cycles as $cycle) {
								echo "<option value={$cycle['id']} required='' class='form-control'>{$cycle['libelle']}</option>";
							}
							?>


						</select>
					</td>

				</tr>
				<tr>
					<td>nom de l'etudiant</td>
					<td><input type="text" name="etudiant" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>mots cles</td>
					<td><input type="textarea" name="mots" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>note obtenue</td>
					<td><input type="number" name="note" required="" class="form-control" /></td>
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
							echo "<option value={$Superviseur['id']} required='' class='form-control'>{$Superviseur['nom_prenom']}</option>";
						}
						?>
					</select>
				</td>
				<tr>
					<td>Annee Accademique</td>
					<td><input type="text" name="annee_acc" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>img_couv</td>
					<td><input type="file" name="img_couv" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>fichier</td>
					<td><input type="file" name="fichier" required="" accept=".pdf" class="form-control" /></td>
				</tr>
				

				<td><input type="submit" name="enregister" value="enregistrer" class="btn btn-primary" /></td>
				<td><input type="reset" value="Effacer" class="btn btn-warning" /></td>
			</table>
		</form>
	</div>
	<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>





<?php require('../include/admin/footer-admin.php') ?>