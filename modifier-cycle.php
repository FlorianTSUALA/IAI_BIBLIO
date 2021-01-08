<?php

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php");

require("../config/config.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "select * from cycle where id =$id";
  $requette = $connexion->prepare($sql);
  $requette->execute();
  $cycle = $requette->fetch();
}

?>

<section class="content">
  <div class="container-fluid">
    <h3>Modifier un cycle</h3>
    <form action="gerer-cycle.php" method="POST">
      <table class="table">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($cycle['id'], ENT_QUOTES) ?>" />
        <tr>
          <td>libelle</td>
          <td><input type="text" name="libelle" required="" class="form-control" value="<?php echo $cycle['libelle'] ?>" /></td>
        </tr>
       
        <td><input type="submit" name=modifier value="modifier" class="btn btn-primary" /></td>
        <td>
          <a href="liste-cycle.php" class="btn btn-warning">Retour</a>
        </td>
      </table>
    </form>
  </div>
  <!-- /.container-fluid -->
</section>

<!-- /.content -->
</div>




<?php require('../include/admin/footer-admin.php') ?>