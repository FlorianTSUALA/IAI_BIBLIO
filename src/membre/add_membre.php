
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Enregistrement dun membre | Gestion Association</title>
  <?php include("../include/header-include.php"); ?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Navbar -->
  <?php include("../include/navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("../include/sidebar.php"); ?>
  <!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion des membres</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Membres</a></li>
              <li class="breadcrumb-item active">Enregistrement</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Enregistrement d'un nouveau membre</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="gerer_membre.php" method="POST">
                <table class="table">
                  <tr>
                    <td>Nom</td>
                    <td><input type="text" name="nom" required="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td>Prenom</td>
                    <td><input type="text" name="prenom" class="form-control"></td>
                  </tr>
                  <tr>
                    <td>Sexe</td>
                    <td>
                      Masculin <input type="radio" name="sexe" value="M" checked>
                      Feminin  <input type="radio" name="sexe" value="F">
                    </td>
                  </tr>
                  <tr>
                    <td>Date de naissance</td>
                    <td><input type="Date" min="<?php echo date('Y')-50;?>-01-01" max="<?php echo date('Y')-18;?>-12-31" name="date_naissance" required="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td>Telephone</td>
                    <td><input type="tel" maxlength="9" pattern="0(6, 7)(2, 4, 5, 6, 7)(0-9)(0-9)" name="telephone" class="form-control"></td>
                  </tr>
                  <tr>
                    <td><input type="submit" name="enregistrer" value="Enregistrer" class="btn btn-info"></td>
                    <td><input type="reset" name="annuler" value="Annuler" class="btn btn-warning"></td>
                  </tr>

                </table>
            </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("../include/footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include("../include/footer-inculde.php"); ?>

</body>
</html>
