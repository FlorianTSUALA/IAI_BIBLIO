

<?php



require_once('../../config/config.php');

    //Liste des membres de l'assocaition
  $sql = "select * from membres;";
  $req = $connexion->prepare($sql);
   $req->execute();
  $personnels = $req->fetchAll();


?>





<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Listes des membres | Gestion Association</title>
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
              <li class="breadcrumb-item active">Liste des membres</li>
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
                <h3 class="card-title">Liste des membres</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nom(s)</th>
                    <th>Prenom(s)</th>
                    <th>Sexe</th>
                    <th>Date naissance</th>
                    <th>Telephone</th>
                    <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $i=0;
                      foreach ($personnels as  $personnel) {
                          $i++;
                          $id = $personnel["id"];
                          $date = $personnel["date_naissance"];
                          //$date = date("l, d F o", $personnel["date_naissance"]);
                          echo "<tr>";
                          echo "<td>   $i </td>";
                          echo "<td> {$personnel["nom"]} </td>";
                          echo "<td> {$personnel["prenom"]} </td>";
                          echo "<td> {$personnel["sexe"]} </td>";
                          echo "<td> {$date} </td>";
                          echo "<td> {$personnel["telephone"]} </td>";
                          echo "<td>
                           <a href='gerer_membre.php?id=$id' onclick=\"return confirm('Voulez vous supprimer ce personnel?');\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
                           &nbsp    &nbsp  &nbsp  &nbsp
                           <a href='update_membre.php?id=$id'><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></a>
                           </td>";
                          echo "</tr>";
                      }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>N°</th>
                    <th>Nom(s)</th>
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Date naissance</th>
                    <th>Telephone</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
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
