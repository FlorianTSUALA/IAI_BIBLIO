<?php require('../include/admin/header-admin.php') ?>
<?php require("../include/admin/nav-admin.php") ?>
<?php require("../include/admin/aside-admin.php") ?>

<!-- SEARCH FORM -->
<?php
require("../config/config.php");

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "select * from utilisateur where id =$id";
	$requette = $connexion->prepare($sql);
	$requette->execute();
	$enseignant = $requette->fetch(); // Fetch permet de recuperer les elements 
}
?>

<section class="content">
	<div class="container-fluid">
		<h3>Ajout un utilisateur</h3>
		<form action="gerer-utilisateur.php" method="POST">
			<table class="table">
				<input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'], ENT_QUOTES) ?>" />
				<tr>
					<td>Nom et prenom</td>
					<td><input type="text" name="nom_prenom" required="" class="form-control" value="<?php echo $enseignant['nom_prenom'] ?>" /></td>
				</tr>
				<tr>
					<td><b>Nom d'utilisateur</b></td>
					<td> <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required></td>
				</tr>
				<tr>
					<td><b>Mot de passe</b></td>
					<td> <input type="password" placeholder="Entrer le mot de passe" name="password" required></td>
				</tr>
				<td><input type="submit" name="modifier" value="Valider" class="btn btn-primary" /></td>
				<td><a href="liste-utilisateur.php" class="btn btn-warning">Retour</a></td>
			</table>
		</form>
	</div>
	<!-- /.container-fluid -->
</section>

<!-- /.content -->
</div>




<?phb p require('../include/admin/footer-admin.php') ?>