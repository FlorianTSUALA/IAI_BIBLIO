
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mise à jour dun document | Gestion Association</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <h1>Gestion des documents</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Document</a></li>
              <li class="breadcrumb-item active">Mise à jour</li>
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
                <h3 class="card-title">Mise à jour d'un nouveau document</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="gerer_archive.php" enctype="multipart/form-data" method="POST">
                <table class="table">
                  <tr>
                    <td>Numero</td>
                    <td><input type="number" name="numero" required="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td>Titre</td>
                    <td><input type="text" name="titre" class="form-control"></td>
                  </tr>

                  <tr>
                    <td>Fichier</td>
                    <td><input type="file" accept=".pdf; .doc; .docx" name="fichier" required="" class="form-control"></td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td><input type="text" name="description" class="form-control"></td>
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
