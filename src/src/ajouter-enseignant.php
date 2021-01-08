<?php 

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php") 

?>

<section class="content">
	<div class="container-fluid">
		<h3>Ajout un enseignant</h3>
		<form action="gerer-enseignant.php" method="POST">
			<table class="table">
				<tr>
					<td>Nom et prenom</td>
					<td><input type="text" name="nom_prenom" required="" class="form-control" /></td>
				</tr>
				<tr>
					<td>Departement</td>
					<td><input type="text" name="departement" required="" class="form-control" /></td>
				</tr>
				<td><input type="submit" name="enregistrer" value="enregistrer" class="btn btn-primary" /></td>
				<td><a href="liste-enseignant.php" class="btn btn-warning">Retour</a></td>
			</table>
		</form>
	</div>
</section> 
</div>




<?php require('../include/admin/footer-admin.php') ?>