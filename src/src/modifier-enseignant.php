<?php

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php");

require("../config/config.php");

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "select * from enseignant where id =$id";
	$requette = $connexion->prepare($sql);
	$requette->execute();
	$enseignant = $requette->fetch();
}

?>

<section class="content">
	<div class="container-fluid">
		<h3>Modifier un enseignant</h3>
		<form action="gerer-enseignant.php" method="POST">
			<table class="table">
				<input type="hidden" name="id" value="<?php echo htmlspecialchars($enseignant['id'], ENT_QUOTES) ?>" />
				<tr>
					<td>Nom et prenom</td>
					<td><input type="text" name="nom_prenom" required="" class="form-control" value="<?php echo $enseignant['nom_prenom'] ?>" /></td>
				</tr>
				<tr>
					<td>Departement</td>
					<td><input type="text" name="departement" required="" class="form-control" value="<?php echo $enseignant['departement'] ?>" /></td>
				</tr>
				<td><input type="submit" name=modifier value="modifier" class="btn btn-primary" /></td>
				<td>
					<a href="liste-enseignant.php" class="btn btn-warning">Retour</a>
				</td>
			</table>
		</form>
	</div>
	<!-- /.container-fluid -->
</section>

<!-- /.content -->
</div>




<?php require('../include/admin/footer-admin.php') ?>