<?php 

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php")

?>

  <section class="content">
      <div class="container-fluid">
          <h3>Ajout un Cycle</h3>
          <form action="gerer-cycle.php" method="POST">
            <table class="table">
              <tr>
                <td>libelle du cycle</td>
                <td><input type="text" name="libelle" required="" class="form-control"/></td>
              </tr>
              <td><input type="submit" name=enregistrer value=enregistrer class="btn btn-primary"/></td>
              <td><input type="reset" value="Effacer" class="btn btn-warning"/></td>
            </table>
          </form>
      </div>
  </section>
  
  



  <?php require('../include/admin/footer-admin.php')?>