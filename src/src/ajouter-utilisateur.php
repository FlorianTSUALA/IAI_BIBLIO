<?php 

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php") 

?>
<!-- SEARCH FORM -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->

    <div class="card-body login-card-body">
      <h3>Ajout un Utilisateur</h3>
      <form action="gerer-utilisateur.php" method="POST">
        <table class="table">
          <div class="input-group mb-3">
            <input type="text" name="nom_prenom" class="form-control" placeholder="nom et prenom">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" name="login" class="form-control" placeholder="login">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
           
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="enregistrer" class="btn btn-primary btn-block">Ajouter</button>
            </div>
            <!-- /.col -->
          </div>
      </form>




      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content -->





<?php require('../include/admin/footer-admin.php') ?>